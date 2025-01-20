<?php

namespace App\Http\Controllers;

use App\Models\ModelProduct;
use App\Models\ModelProductStock;
use App\Models\ModelProductSerials;
use App\Models\ModelWholesaleCustomer;
use App\Models\ModelPerpajakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class KasirController extends Controller
{
    public function index()
    {
        // Check if type is not set, default to ecer
        if (!session()->has('type')) {
            session(['type' => 'ecer']);
        }
        
        $pajak = ModelPerpajakan::where('outlet_id', session('outlet_id'))
                               ->first();

        return view('kasir.index', [
            'pajak' => $pajak ? $pajak->pajak : 11 // default 11% if not set
        ]);
    }

    public function selectWholesaleCustomer()
    {
        // Set session type to grosir
        session(['type' => 'grosir']);
        
        $customers = ModelWholesaleCustomer::where('customer_outlet_id', session('outlet_id'))
            ->orderBy('customer_name')
            ->get();
        
        return view('kasir.select-customer', ['customers' => $customers]);
    }

    public function grosir($customer_id)
    {
        session([
            'type' => 'grosir',
            'wholesale_customer_id' => $customer_id,
            'customer_id' => $customer_id // Add both for compatibility
        ]);
        
        $customer = ModelWholesaleCustomer::where('wholesale_customer_id', $customer_id)
            ->where('customer_outlet_id', session('outlet_id'))
            ->firstOrFail();
        
        $pajak = ModelPerpajakan::where('outlet_id', session('outlet_id'))
                               ->first();
            
        return view('kasir.index', [
            'customer' => $customer,
            'pajak' => $pajak ? $pajak->pajak : 11 // default 11% if not set
        ]);
    }

    public function ecer()
    {
        session(['type' => 'ecer']);
        
        $pajak = ModelPerpajakan::where('outlet_id', session('outlet_id'))
                               ->first();
                               
        return view('kasir.index', [
            'pajak' => $pajak ? $pajak->pajak : 11 // default 11% if not set
        ]);
    }

    public function searchProducts(Request $request)
    {
        try {
            $term = $request->term;
            $outletId = session('outlet_id');
            
            // Enhanced initial logging
            Log::info('Search Products Started', [
                'term' => $term,
                'outlet_id' => $outletId,
                'session_type' => session('type'),
                'user_agent' => $request->header('User-Agent'),
                'ip' => $request->ip()
            ]);
            
            if (!$outletId) {
                Log::error('Outlet ID Missing', ['session' => session()->all()]);
                throw new Exception('Outlet ID not found in session');
            }

            $products = ModelProduct::with(['productStock', 'serials' => function($query) {
                $query->where('status', 'tersedia');
            }])
            ->where('outlet_id', $outletId)
            ->where(function($query) use ($term) {
                $query->where('product_name', 'LIKE', "%{$term}%")
                      ->orWhere('product_code', 'LIKE', "%{$term}%");
            })
            ->get();

            // Log query results
            Log::info('Products Query Result', [
                'count' => $products->count(),
                'search_term' => $term,
                'first_product' => $products->first() ? [
                    'name' => $products->first()->product_name,
                    'has_serial' => $products->first()->has_serial_number ? 'Yes' : 'No'
                ] : 'none'
            ]);

            $mappedProducts = $products->map(function($product) {
                $price = session('type') === 'grosir' ? $product->price_grosir : $product->price;
                $stock = optional($product->productStock->first())->stock ?? 0;
                $hasSerial = (bool)$product->has_serial_number;
                
                // Enhanced serial number handling
                $serials = [];
                if ($hasSerial) {
                    $serials = $product->serials
                        ->pluck('serial_number')
                        ->toArray();
                        
                    Log::debug('Serial Numbers', [
                        'product_id' => $product->product_id,
                        'product_name' => $product->product_name,
                        'has_serial' => $hasSerial,
                        'serial_count' => count($serials),
                        'first_few_serials' => array_slice($serials, 0, 3)
                    ]);
                }
                
                return [
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'product_code' => $product->product_code ?? '',
                    'price' => $price,
                    'stock' => $stock,
                    'has_serial' => $hasSerial,
                    'serials' => $serials,
                    'unit' => $product->unit ?? 'pcs',
                    'serial_count' => count($serials)
                ];
            });

            Log::info('Search Products Completed', [
                'total_mapped' => $mappedProducts->count(),
                'response_size' => strlen(json_encode($mappedProducts))
            ]);

            return response()->json($mappedProducts);

        } catch (Exception $e) {
            Log::error('Search Products Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'session' => session()->all(),
                'request' => $request->all()
            ]);
            
            return response()->json([
                'error' => 'Terjadi kesalahan saat mencari produk',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getProduct($id)
    {
        $outletId = session('outlet_id');
        $product = ModelProduct::with(['productStock', 'serials'])
            ->where('product_id', $id)
            ->where('outlet_id', $outletId)
            ->whereHas('productStock', function($query) use ($outletId) {
                $query->where('outlet_id', $outletId)
                    ->where('stock', '>', 0);
            })
            ->first();

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $data = [
            'product_id' => $product->product_id,
            'product_name' => $product->product_name,
            'product_code' => $product->product_code,
            'price' => session('type') === 'grosir' ? $product->price_grosir : $product->price,
            'stock' => $product->productStock->first()->stock ?? 0,
            'has_serial' => $product->has_serial_number,
            'unit' => $product->unit,
            'serials' => $product->has_serial_number ? 
                $product->serials->where('status', 'tersedia')
                    ->pluck('serial_number') : []
        ];

        return response()->json($data);
    }

    public function getProductByBarcode($barcode)
    {
        try {
            $outletId = session('outlet_id');
            
            Log::debug('Barcode scan request initiated', [
                'barcode' => $barcode,
                'outlet_id' => $outletId
            ]);

            // Clean the barcode input
            $barcode = trim($barcode);
            
            if (empty($barcode)) {
                return response()->json(['error' => 'Barcode tidak boleh kosong'], 400);
            }

            // First try to find product by product_code
            $product = ModelProduct::where('outlet_id', $outletId)
                ->where('product_code', $barcode)
                ->with(['productStock' => function($query) use ($outletId) {
                    $query->where('outlet_id', $outletId);
                }, 'serials' => function($query) {
                    $query->where('status', 'tersedia');
                }])
                ->first();

            // If not found by product_code, try to find by serial number
            if (!$product) {
                $serial = ModelProductSerials::where('serial_number', $barcode)
                    ->where('outlet_id', $outletId)
                    ->where('status', 'tersedia')
                    ->first();

                if ($serial) {
                    $product = ModelProduct::where('outlet_id', $outletId)
                        ->where('product_id', $serial->product_id)
                        ->with(['productStock' => function($query) use ($outletId) {
                            $query->where('outlet_id', $outletId);
                        }, 'serials' => function($query) {
                            $query->where('status', 'tersedia');
                        }])
                        ->first();
                }
            }

            if (!$product) {
                Log::warning('Product not found for barcode', ['barcode' => $barcode]);
                return response()->json(['error' => 'Produk tidak ditemukan'], 404);
            }

            // Get stock from product_stock table
            $stock = $product->productStock->first()->stock ?? 0;

            // Prepare response data
            $responseData = [
                'product_id' => $product->product_id,
                'product_name' => $product->product_name,
                'product_code' => $product->product_code,
                'price' => session('type') === 'grosir' ? $product->price_grosir : $product->price,
                'stock' => $stock,
                'has_serial' => (bool)$product->has_serial_number,
                'unit' => $product->unit ?? 'pcs'
            ];

            // Add serial numbers if product has serials
            if ($product->has_serial_number) {
                $responseData['serials'] = $product->serials->pluck('serial_number')->toArray();
                if (!empty($barcode) && in_array($barcode, $responseData['serials'])) {
                    $responseData['selected_serial'] = $barcode;
                }
            }

            Log::info('Product found for barcode', [
                'barcode' => $barcode,
                'product_id' => $product->product_id,
                'has_serial' => (bool)$product->has_serial_number
            ]);

            return response()->json($responseData);

        } catch (Exception $e) {
            Log::error('Error in barcode scanning', [
                'barcode' => $barcode,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'error' => 'Terjadi kesalahan saat memproses barcode',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
