<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Models\ModelUser;
use App\Models\ModelOutlet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use App\Models\HeldTransaction;
use App\Models\ModelTransaction;
use App\Models\ModelProductStock;
use App\Models\ModelProductSerials;
use Illuminate\Support\Facades\Log;
use App\Models\ModelHeldTransaction;
use App\Models\ModelTransactionItem;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\HeldTransactionResource;
use App\Models\ModelActivityLog; // Add this at the top with other use statements

class TransactionController extends Controller
{
    public function processPayment(Request $request)
    {
        try {
            DB::beginTransaction();
            
            // Validate incoming request
            $request->validate([
                'items' => 'required|array',
                'total_amount' => 'required|numeric',
                'payment_method' => 'required|string',
                'paid_amount' => 'required|numeric',
            ]);

            // Create transaction
            $transaction = Transaction::create([
                'outlet_id' => session('outlet_id'),
                'customer_id' => session('customer_id'),
                'total_amount' => $request->total_amount,
                'paid_amount' => $request->paid_amount,
                'change_amount' => $request->paid_amount - $request->total_amount,
                'payment_status' => 'paid',
                'status' => 'completed'
            ]);

            // Create payment details
            $paymentDetail = PaymentDetail::create([
                'transaction_id' => $transaction->id,
                'payment_method' => $request->payment_method,
                'amount' => $request->paid_amount,
                'reference_number' => $request->reference_number ?? null,
                'card_number' => $request->card_number ?? null,
                'approval_code' => $request->approval_code ?? null,
                'bank_name' => $request->bank_name ?? null,
            ]);

            // Update stock
            foreach ($request->items as $item) {
                if ($item['has_serial']) {
                    // Update serial status
                    ModelProductSerials::where('serial_number', $item['serial_number'])
                        ->update(['status' => 'sold']);
                } else {
                    // Update regular stock
                    ModelProductStock::where('product_id', $item['product_id'])
                        ->where('outlet_id', session('outlet_id'))
                        ->decrement('stock', $item['quantity']);
                }
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'transaction_id' => $transaction->id
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function holdTransaction(Request $request)
    {
        try {
            $validated = $request->validate([
                'items' => 'required|array',
                'total_amount' => 'required|numeric',
                'note' => 'nullable|string'
            ]);

            $sale_type = session('type');
            log::info('Sale type: ' . $sale_type);
            
            // Build transaction data
            $data = [
                'outlet_id' => session('outlet_id'),
                'operator_id' => session('user_id'),
                'total_amount' => $validated['total_amount'],
                'note' => $validated['note'],
                'items_json' => json_encode($validated['items']),
                'sale_type' => $sale_type,
                'created_by' => Auth::check() ? Auth::user()->id : null,
                'customer_id' => session('customer_id') ?? null
            ];

            $transaction = ModelHeldTransaction::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Transaction held successfully',
                'data' => $transaction
            ]);

        } catch (\Exception $e) {
            Log::error('Error holding transaction', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
                'session' => [
                    'type' => session('type'),
                    'customer_id' => session('customer_id')
                ]
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getHeldTransactions()
    {
        try {
            $transactions = ModelHeldTransaction::where('outlet_id', session('outlet_id'))
                ->where('sale_type', session('type', 'ecer'))
                ->select(
                    'held_transaction_id as id',
                    'created_at',
                    'total_amount',
                    'note',
                    'sale_type'
                )
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $transactions
            ]);

        } catch (\Exception $e) {
            Log::error('Error retrieving held transactions', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error loading transactions: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getHeldTransaction($id)
    {
        try {
            $transaction = ModelHeldTransaction::where('outlet_id', session('outlet_id'))
                ->where('held_transaction_id', $id)
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'items' => json_decode($transaction->items_json),
                'total_amount' => $transaction->total_amount,
                'note' => $transaction->note
            ]);

        } catch (\Exception $e) {
            Log::error('Error retrieving held transaction', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }
    }

    public function cleanupHeldTransactions($days = 7)
    {
        try {
            $cutoffDate = now()->subDays($days);
            $count = ModelHeldTransaction::where('created_at', '<', $cutoffDate)->delete();
            
            Log::info("Manual cleanup of held transactions", [
                'deleted_count' => $count,
                'days' => $days
            ]);
            
            return response()->json([
                'success' => true,
                'message' => "Deleted {$count} old held transactions"
            ]);
        } catch (\Exception $e) {
            Log::error("Error in manual cleanup", [
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to cleanup transactions'
            ], 500);
        }
    }

    public function deleteHeldTransaction($id)
    {
        try {
            $transaction = ModelHeldTransaction::where('outlet_id', session('outlet_id'))
                ->where('held_transaction_id', $id)
                ->firstOrFail();

            $transaction->delete();

            return response()->json([
                'success' => true,
                'message' => 'Transaction deleted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Error deleting held transaction', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete transaction'
            ], 500);
        }
    }

    public function index() 
    {
        log::info('Showing transactions index');
        // Get operators from current outlet
        $operators = ModelUser::where('outlet_id', session('outlet_id'))
            ->select('user_id', 'username')
            ->get();

        $isParentUser = Auth::user()->is_parent == 1;
        
        // Get transactions with filter
        $query = ModelTransaction::with(['user', 'outlet', 'items'])
            ->select([
                'transaction_id', 'user_id', 'outlet_id', 
                'total_amount', 'payment_method', 'status',
                'sale_type', 'created_at'
            ])
            ->withCount('items');

        // Apply operator filter if selected
        if (request('operator_id')) {
            $query->where('user_id', request('operator_id'));
        }

        if (!request('show_group')) {
            $query->where('outlet_id', session('outlet_id'));
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        return view('transactions.index', compact('transactions', 'operators', 'isParentUser'));
    }

    public function getOutletGroupTransactions()
    {
        Log::info('getOutletGroupTransactions accessed', [
            'user' => Auth::user(),
            'is_parent' => Auth::user()->is_parent
        ]);

        // Check if user is parent
        if (Auth::user()->is_parent != 1) {
            Log::warning('Unauthorized access attempt to group transactions');
            return redirect()->route('transactions.index')
                ->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        // Get current outlet
        $currentOutlet = ModelOutlet::with('outletGroup')
            ->find(session('outlet_id'));
        
        Log::info('Current outlet', [
            'outlet' => $currentOutlet,
            'group_id' => $currentOutlet->outlet_group_id ?? null
        ]);
        
        if (!$currentOutlet || !$currentOutlet->outlet_group_id) {
            Log::warning('Outlet group not found');
            return redirect()->route('transactions.index')
                ->with('error', 'Outlet group tidak ditemukan');
        }

        // Get all transactions from outlets in the same group
        $transactions = ModelTransaction::with(['user', 'outlet'])
            ->whereHas('outlet', function($query) use ($currentOutlet) {
                $query->where('outlet_group_id', $currentOutlet->outlet_group_id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        Log::info('Found transactions', [
            'count' => $transactions->count()
        ]);

        return view('transactions.group', compact('transactions', 'currentOutlet'));
    }

    public function show($id)
    {
        $transaction = ModelTransaction::with([
            'items.product', 
            'user', 
            'outlet', 
            'wholesaleCustomer'
        ])
        ->findOrFail($id);

        return view('transactions.show', compact('transaction'));
    }

    public function printReceipt($id)
    {
        $transaction = ModelTransaction::with(['items.product', 'user', 'outlet', 'wholesaleCustomer'])
            ->findOrFail($id);

        return view('transactions.receipt', compact('transaction'));
    }

    public function cancelItem(Request $request, $itemId)
    {
        try {
            Log::info('Starting item cancellation', [
                'item_id' => $itemId,
                'request_data' => $request->all()
            ]);

            DB::beginTransaction();

            $item = ModelTransactionItem::with(['product', 'productSerial', 'transaction'])
                ->findOrFail($itemId);

            Log::info('Found item', [
                'item' => $item->toArray()
            ]);

            // Check if item can be cancelled (24 jam)
            if (now()->diffInHours($item->created_at) > 24) {
                throw new Exception('Item tidak dapat dibatalkan karena sudah lebih dari 24 jam');
            }

            // Check if item already cancelled
            if ($item->transaction_items_status === 'cancelled') {
                throw new Exception('Item sudah dibatalkan');
            }

            // Handle serial product
            if ($request->isSerial && $request->serialId) {
                Log::info('Updating serial product', [
                    'serial_id' => $request->serialId
                ]);

                DB::table('product_serials')
                    ->where('serial_id', $request->serialId)
                    ->update(['status' => 'tersedia']);
            } else {
                Log::info('Updating stock product', [
                    'product_id' => $item->product_id,
                    'outlet_id' => $item->outlet_id,
                    'quantity' => $item->quantity
                ]);

                $stockUpdateResult = DB::table('product_stock')
                    ->where('product_id', $item->product_id)
                    ->where('outlet_id', $item->outlet_id)
                    ->increment('stock', $item->quantity);

                Log::info('Stock update result', ['result' => $stockUpdateResult]);
            }

            // Update item status
            $updateData = [
                'transaction_items_status' => 'cancelled',
                'cancel_reason' => $request->reason ?? 'Dibatalkan oleh operator',
                'cancelled_at' => now(),
                'cancelled_by' => Auth::id()
            ];

            Log::info('Updating item status', ['update_data' => $updateData]);
            
            $item->update($updateData);

            // Update total amount transaksi
            $transaction = $item->transaction;
            $newTotal = $transaction->total_amount - $item->subtotal;
            
            Log::info('Updating transaction total', [
                'old_total' => $transaction->total_amount,
                'subtotal' => $item->subtotal,
                'new_total' => $newTotal
            ]);

            $transaction->update(['total_amount' => $newTotal]);

            // Log aktivitas
            $logData = [
                'activity_log_operator_id' => Auth::id(),
                'activity_log_outlet_id' => session('outlet_id'),
                'action' => 'cancelled_transaction_item',
                'description' => json_encode([
                    'transaction_id' => $transaction->transaction_id,
                    'item_id' => $item->transaction_item_id,
                    'product_name' => $item->product->product_name,
                    'quantity' => $item->quantity,
                    'reason' => $request->reason ?? 'Dibatalkan oleh operator'
                ])
            ];

            Log::info('Creating activity log', ['log_data' => $logData]);
            
            ModelActivityLog::create($logData);

            DB::commit();
            Log::info('Transaction completed successfully');

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dibatalkan',
                'new_total' => $newTotal
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in cancelItem', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'item_id' => $itemId,
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function salesReport(Request $request)
    {
        $query = ModelTransaction::with(['user', 'outlet', 'items.product', 'wholesaleCustomer'])
            ->select([
                'transactions.transaction_id',
                'transactions.user_id',
                'transactions.outlet_id',
                'transactions.wholesale_customer_id',
                'transactions.total_amount',
                'transactions.payment_method',
                'transactions.status',
                'transactions.created_at',
                DB::raw('COUNT(transaction_items.transaction_item_id) as items_count'),
                DB::raw('SUM(transaction_items.quantity) as total_items')
            ])
            ->leftJoin('transaction_items', 'transactions.transaction_id', '=', 'transaction_items.transaction_id')
            ->where('transactions.outlet_id', session('outlet_id'))
            ->groupBy(
                'transactions.transaction_id',
                'transactions.user_id',
                'transactions.outlet_id',
                'transactions.wholesale_customer_id',
                'transactions.total_amount',
                'transactions.payment_method',
                'transactions.status',
                'transactions.created_at'
            );

        // Date filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('transactions.created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('transactions.status', $request->status);
        }

        // Payment method filter
        if ($request->filled('payment_method')) {
            $query->where('transactions.payment_method', $request->payment_method);
        }

        $transactions = $query->orderBy('transactions.created_at', 'desc')->get();

        $summary = [
            'total_transactions' => $transactions->count(),
            'total_sales' => $transactions->sum('total_amount'),
            'total_items' => $transactions->sum('total_items'),
            'average_transaction' => $transactions->count() > 0 
                ? $transactions->sum('total_amount') / $transactions->count() 
                : 0
        ];

        return view('reports.sales', compact('transactions', 'summary'));
    }

    public function groupSalesReport(Request $request)
    {
        // Verify user is parent
        if (!Auth::user()->is_parent) {
            return redirect()->route('sales.report')
                ->with('error', 'Unauthorized access');
        }

        // Get current outlet group
        $currentOutlet = ModelOutlet::with('outletGroup')
            ->find(session('outlet_id'));

        if (!$currentOutlet || !$currentOutlet->outlet_group_id) {
            return redirect()->route('sales.report')
                ->with('error', 'No outlet group found');
        }

        $query = ModelTransaction::with(['user', 'outlet', 'items.product', 'wholesaleCustomer'])
            ->select([
                'transactions.transaction_id',
                'transactions.user_id',
                'transactions.outlet_id',
                'transactions.wholesale_customer_id',
                'transactions.total_amount',
                'transactions.payment_method',
                'transactions.status',
                'transactions.created_at',
                DB::raw('COUNT(transaction_items.transaction_item_id) as items_count'),
                DB::raw('SUM(transaction_items.quantity) as total_items')
            ])
            ->leftJoin('transaction_items', 'transactions.transaction_id', '=', 'transaction_items.transaction_id')
            ->whereHas('outlet', function($q) use ($currentOutlet) {
                $q->where('outlet_group_id', $currentOutlet->outlet_group_id);
            })
            ->groupBy(
                'transactions.transaction_id',
                'transactions.user_id',
                'transactions.outlet_id',
                'transactions.wholesale_customer_id',
                'transactions.total_amount',
                'transactions.payment_method',
                'transactions.status',
                'transactions.created_at'
            );

        // Apply filters
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('transactions.created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        if ($request->filled('status')) {
            $query->where('transactions.status', $request->status);
        }

        if ($request->filled('payment_method')) {
            $query->where('transactions.payment_method', $request->payment_method);
        }

        if ($request->filled('outlet_id')) {
            $query->where('transactions.outlet_id', $request->outlet_id);
        }

        $transactions = $query->orderBy('transactions.created_at', 'desc')->get();
        
        $outlets = ModelOutlet::where('outlet_group_id', $currentOutlet->outlet_group_id)
            ->select('outlet_id', 'outlet_name')
            ->get();

        $summary = [
            'total_transactions' => $transactions->count(),
            'total_sales' => $transactions->sum('total_amount'),
            'total_items' => $transactions->sum('total_items'),
            'average_transaction' => $transactions->count() > 0 
                ? $transactions->sum('total_amount') / $transactions->count() 
                : 0
        ];

        return view('reports.sales', compact('transactions', 'summary', 'outlets'));
    }
}