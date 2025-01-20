<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelTransaction;
use App\Models\ModelTransactionItem;
use App\Models\ModelProductStock;
use App\Models\ModelProductSerials;
use App\Models\ModelDiscount;
use Illuminate\Support\Facades\DB;
use Exception;

class PaymentController extends Controller
{
    protected function calculateDiscount($item)
    {
        try {
            $discount = ModelDiscount::where('is_active', 1)
                ->where('tipe_kasir', session('type'))
                ->where(function($query) {
                    $query->whereNull('discount_outlet_id')
                        ->orWhere('discount_outlet_id', session('outlet_id'));
                })
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->where(function($query) use ($item) {
                    $query->where(function($q) use ($item) {
                        $q->where('applies_to', 'product')
                          ->where('product_id', $item['product_id']);
                    })->orWhere(function($q) use ($item) {
                        $q->where('applies_to', 'category')
                          ->whereExists(function($subquery) use ($item) {
                              $subquery->select(DB::raw(1))
                                      ->from('products')
                                      ->whereRaw('products.product_id = ?', [$item['product_id']])
                                      ->whereRaw('products.category_id = discounts.category_id');
                          });
                    });
                })
                ->orderBy('value', 'desc')
                ->first();

            if (!$discount) {
                return [
                    'discount' => 0,
                    'discount_type' => null,
                    'value' => 0
                ];
            }

            $discountAmount = 0;
            if ($discount->type === 'percentage') {
                $discountAmount = ($item['price'] ?? 0) * ($discount->value / 100);
            } else {
                $discountAmount = $discount->value;
            }

            return [
                'discount' => $discountAmount,
                'discount_type' => $discount->type,
                'value' => $discount->value
            ];

        } catch (\Exception $e) {
            \Log::error('Error calculating discount:', [
                'item' => $item,
                'error' => $e->getMessage()
            ]);
            return [
                'discount' => 0,
                'discount_type' => null,
                'value' => 0
            ];
        }
    }

    public function processPayment(Request $request)
    {
        DB::beginTransaction();
        
        try {
            // Log the entire request for debugging
            \Log::info('Payment Request:', $request->all());

            // Validate request with more flexible rules
            $validated = $request->validate([
                'payment_method' => 'required|string|in:cash,debit,credit,qris',
                'total_amount' => 'required|numeric|min:0',
                'payment_amount' => 'required|numeric|min:0',
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|integer|exists:products,product_id',
                'items.*.quantity' => 'required|integer|min:1',
                'items.*.price' => 'required|numeric|min:0',
                'bank_id' => 'nullable|integer|exists:banks,bank_id'
            ]);

            \Log::info('Validated Payment Data:', [
                'payment_method' => $request->payment_method,
                'payment_amount' => $request->payment_amount,
                'total_amount' => $request->total_amount,
                'items_count' => count($request->items)
            ]);

            // Convert amounts to integers if needed
            $totalAmount = (int)$request->total_amount;
            $paymentAmount = (int)$request->payment_amount;
            $changeAmount = $paymentAmount - $totalAmount;

            // Create transaction with safe type casting
            $transaction = ModelTransaction::create([
                'outlet_id' => (int)session('outlet_id'),
                'wholesale_customer_id' => session('wholesale_customer_id') ? (int)session('wholesale_customer_id') : null,
                'user_id' => (int)session('user_id'),
                'total_amount' => $totalAmount,
                'paid_amount' => $totalAmount,
                'received_amount' => $paymentAmount,
                'change_amount' => $changeAmount,
                'payment_method' => strval($request->payment_method),
                'payment_status' => $changeAmount >= 0 ? 'lunas' : 'bon',
                'status' => 'completed',
                'sale_type' => strval(session('type')),
                'bank_id' => $request->bank_id ? (int)$request->bank_id : null,
                'transaction_date' => now()
            ]);

            \Log::info('Transaction Created:', ['transaction_id' => $transaction->transaction_id]);

            // Process items with improved serial handling
            foreach ($request->items as $item) {
                try {
                    // Calculate discount for this item
                    $discountInfo = $this->calculateDiscount($item);

                    $transactionItemData = [
                        'transaction_id' => $transaction->transaction_id,
                        'product_id' => (int)$item['product_id'],
                        'user_id' => (int)session('user_id'),
                        'outlet_id' => (int)session('outlet_id'),
                        'quantity' => (int)$item['quantity'],
                        'price' => (int)$item['price'],
                        'discount' => $discountInfo['discount'],
                        'discount_type' => $discountInfo['discount_type'],
                        'subtotal' => (int)($item['price'] * $item['quantity']) - $discountInfo['discount'],
                        'transaction_date' => now(),
                        'transaction_items_status' => 'finish'
                    ];

                    if (!empty($item['selected_serial'])) {
                        // Get serial record and its ID
                        $serial = ModelProductSerials::where('serial_number', $item['selected_serial'])
                            ->where('outlet_id', session('outlet_id'))
                            ->where('product_id', $item['product_id'])
                            ->where('status', 'tersedia')
                            ->first();

                        if (!$serial) {
                            throw new \Exception("Serial number not found or already sold: {$item['selected_serial']}");
                        }

                        // Add serial_id to transaction item data
                        $transactionItemData['serial_id'] = $serial->serial_id;

                        // Update serial status
                        $updated = $serial->update(['status' => 'terjual']);
                        if (!$updated) {
                            throw new \Exception("Failed to update serial status: {$item['selected_serial']}");
                        }
                    } else {
                        // Handle non-serial products
                        $stock = ModelProductStock::where('product_id', $item['product_id'])
                            ->where('outlet_id', session('outlet_id'))
                            ->lockForUpdate()
                            ->first();

                        if (!$stock) {
                            throw new \Exception("Stock not found for product: {$item['product_id']}");
                        }

                        if ($stock->stock < $item['quantity']) {
                            throw new \Exception("Insufficient stock for product: {$item['product_id']}");
                        }

                        // Add product_stocks_id to transaction item data
                        $transactionItemData['product_stocks_id'] = $stock->product_stock_id;

                        $stock->stock -= $item['quantity'];
                        $stock->save();
                    }

                    // Create transaction item with all data
                    ModelTransactionItem::create($transactionItemData);

                } catch (\Exception $e) {
                    \Log::error('Error processing item:', [
                        'item' => $item,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    throw $e;
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil',
                'transaction' => $transaction->load('items'),
                'receipt_url' => route('receipt.print', ['id' => $transaction->transaction_id])
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Payment Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pembayaran',
                'debug_message' => $e->getMessage()
            ], 500);
        }
    }

    public function getReceipt($transactionId)
    {
        $transaction = ModelTransaction::with([
            'items.product', 
            'wholesaleCustomer', 
            'user', 
            'outlet'
        ])->findOrFail($transactionId);

        // Get tax rate from ModelPerpajakan
        $taxRate = \App\Models\ModelPerpajakan::where('outlet_id', $transaction->outlet_id)
            ->value('pajak') ?? 11; // Default to 11% if not set

        // Calculate tax amount if needed
        $transaction->tax_rate = $taxRate;

        return view('kasir.receipt', compact('transaction'));
    }

    public function generateQRExample()
    {
        // Create a blank image
        $image = imagecreatetruecolor(300, 300);
        
        // White background
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $white);
        
        // Add QRIS text
        $black = imagecolorallocate($image, 0, 0, 0);
        imagestring($image, 5, 100, 140, "QRIS", $black);
        imagestring($image, 3, 70, 160, "Scan to pay", $black);
        
        // Save image
        $path = public_path('images/qr/qris-example.png');
        imagepng($image, $path);
        imagedestroy($image);
    }

    public function getDiscount($productId)
    {
        $item = ['product_id' => (int)$productId];
        $result = $this->calculateDiscount($item);
        
        return response()->json($result);
    }
}
