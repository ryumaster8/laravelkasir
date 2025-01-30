<?php

namespace App\Http\Controllers;

use App\Models\ModelOutlet;
use App\Models\ModelProduct;
use Illuminate\Http\Request;
use App\Models\ModelProducts;
use App\Models\ModelSuppliers;
use App\Models\ModelCategories;
use App\Models\ModelActivityLog;
use App\Models\ModelProductStock;
use App\Models\StockNotification;
use App\Models\ModelProductImages;
use App\Models\ModelProductSerials;
use App\Models\ModelProductTransit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; // Import Rule
use Illuminate\Support\Facades\DB; // Tambahkan ini
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth; // Jika Anda menggunakan Auth

class ProductsController extends Controller
{

    public function create()
    {
        $outletId = session('outlet_id');
        $userId = session('user_id');
        if (!$outletId) {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu!');
        }
        $outletName = \App\Models\ModelOutlet::where('outlet_id', $outletId)->value('outlet_name');
        $username = \App\Models\ModelUser::where('user_id', $userId)->value('username');
        $categories = ModelCategories::where('outlet_id', $outletId)->get();
        $suppliers = ModelSuppliers::where('outlet_id', $outletId)->get();

        Log::info('ProductsController@create: Session data set', ['outletName' => $outletName, 'username' => $username]);
        if ($categories->isEmpty()) {
            return redirect()->route('categories.index')->with('error', 'Kategori belum ada. Silakan tambahkan kategori terlebih dahulu sebelum menambahkan produk!');
        }

        if ($suppliers->isEmpty()) {
            return redirect()->route('suppliers.index')->with('error', 'Supplier belum ada. Silakan tambahkan supplier terlebih dahulu sebelum menambahkan produk!');
        }
        return view('admin.products.add', compact('categories', 'suppliers', 'outletName', 'username'));
    }
    public function edit(ModelProduct $product)
    {
        // ambil user yang login
        $user = Auth::user();
        Log::debug('User ID :' .  $user->user_id);
        Log::debug('User Name :' .  $user->username);


        //ambil kategori dan supplier
        $categories = ModelCategories::all();
        $suppliers = ModelSuppliers::all();

        return view('admin.products.edit_self_product', compact('product', 'user', 'categories', 'suppliers'));
    }
    public function update(Request $request, ModelProduct $product)
    {
        // Validasi data
        $request->validate([
            'product_name' => [
                'required',
                Rule::unique('products')->where(function ($query) use ($product) {
                    return $query->where('outlet_id', $product->outlet_id)->where('product_id', '<>', $product->product_id);
                })
            ],
            'brand' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'supplier_id' => 'required|exists:suppliers,supplier_id',
        ]);
        // Update data produk
        $product->update([
            'product_name' => $request->input('product_name'),
            'brand' => $request->input('brand'),
            'category_id' => $request->input('category_id'),
            'supplier_id' => $request->input('supplier_id'),
        ]);
        return redirect()->route('self-products')->with('success', 'Product updated successfully!');
    }
    public function editNonSerial(ModelProduct $product)
    {
        // ambil user yang login
        $user = Auth::user();

        //ambil kategori dan supplier
        $categories = ModelCategories::all();
        $suppliers = ModelSuppliers::all();


        return view('admin.products.edit_self_product_non_serial', compact('product', 'user', 'categories', 'suppliers'));
    }
    public function updateNonSerial(Request $request, ModelProduct $product)
    {
        // Validasi data
        $request->validate([
            'product_name' => [
                'required',
                Rule::unique('products')->where(function ($query) use ($product) {
                    return $query->where('outlet_id', $product->outlet_id)->where('product_id', '<>', $product->product_id);
                })
            ],
            'brand' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'price_modal' => 'required|numeric|min:0',
            'price_grosir' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'unit' => 'nullable|string|max:50',

        ]);
        // Update data produk
        $product->update([
            'product_name' => $request->input('product_name'),
            'brand' => $request->input('brand'),
            'category_id' => $request->input('category_id'),
            'supplier_id' => $request->input('supplier_id'),
            'price_modal' => $request->input('price_modal'),
            'price_grosir' => $request->input('price_grosir'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
        ]);
        return redirect()->route('self-products')->with('success', 'Product updated successfully!');
    }
    public function addSerial(ModelProduct $product)
    {
        // ambil user yang login
        $user = Auth::user();

        return view('admin.products.add_serial', compact('product', 'user'));
    }
    public function storeSerial(Request $request, ModelProduct $product)
    {
        // Validasi data
        $request->validate([
            'serial_number' => [
                'required',
                Rule::unique('product_serials')->where(function ($query) use ($product) {
                    return $query->where('product_id', $product->product_id);
                })
            ],
        ]);

        // simpan data serial number
        ModelProductSerials::create([
            'product_id' => $product->product_id,
            'outlet_id' => $product->outlet_id,
            'user_id' => Auth::user()->user_id,
            'serial_number' => $request->input('serial_number')
        ]);
        return redirect()->back()->with('success', 'Serial number added successfully!');
    }
    public function reduceUnit(ModelProduct $product)
    {
        // ambil user yang login
        $user = Auth::user();
        $availableSerials = $product->serials()->where('status', 'tersedia')->count();

        return view('admin.products.reduce_unit', compact('product', 'user', 'availableSerials'));
    }
    public function transferUnit(ModelProduct $product)
    {
        // ambil user yang login
        $user = Auth::user();
        $outletId = $user->outlet_id;

        //ambil outlet yang 1 group
        $outlets = ModelOutlet::where('outlet_group_id', $user->outlet->outlet_group_id)->where('outlet_id', '<>', $user->outlet_id)->get();

        // Mengambil data serial produk yang available di outlet yang login
        $serials = $product->serials()
            ->where('outlet_id', $outletId)
            ->where('status', 'tersedia')
            ->get();
        

        return view('admin.products.transfer_unit', compact('product', 'user', 'outlets', 'serials'));
    }

    public function storeTransferUnit(Request $request, ModelProduct $product)
    {
         // Validasi Data
        $request->validate([
          'to_outlet_id' => ['required', 'exists:outlets,outlet_id'],
          'selected_serials' => ['required', 'array', 'min:1'],
             'selected_serials.*' => ['exists:product_serials,serial_id'] // Validasi setiap serial yang dipilih
         ]);
         // Ambil user yang login
        $user = Auth::user();
        $fromOutletId = $user->outlet_id;

         // Validate target outlet is in same group
        $target_outlet = ModelOutlet::where('outlet_id', $request->to_outlet_id)
            ->where('outlet_group_id', $user->outlet->outlet_group_id)
            ->first();

        if (!$target_outlet) {
            return redirect()->back()->with('error', 'Outlet tujuan tidak valid atau tidak dalam satu grup');
        }

        $transits = [];
        // simpan data pindah unit untuk setiap serial yang dipilih
        foreach ($request->input('selected_serials') as $serialId) {
           $serial = ModelProductSerials::find($serialId);
            if($serial){
                  // Simpan data pada tabel product_transits
                 $transit = ModelProductTransit::create([
                     'product_id' => $product->product_id,
                      'serial_id' => $serialId,
                       'from_outlet_id' => $fromOutletId,
                      'to_outlet_id' => $request->input('to_outlet_id'),
                      'user_id' => $user->user_id,
                     'operator_sender' => $user->user_id,
                      'has_serial_number' => 1,
                     'status' => 'transit',
                ]);
                 //update status serial number menjadi transit
                 $serial->status = 'transit';
                 $serial->save();
                 $transits[] = $transit;
          }

       }

        return redirect()->route('products.transfer-requests-submission')->with('success', 'Permintaan pemindahan produk berhasil diajukan');
    }

    public function addStock(ModelProduct $product)
    {
        // Ambil data user yang login
        $user = Auth::user();
        $outletId = $user->outlet_id;

        // Ambil data stok dari tabel product_stock
        $productStock = ModelProductStock::where('product_id', $product->product_id)
            ->where('outlet_id', $outletId)
            ->first();

        // Mengambil Data product (pastikan product sudah lengkap dengan semua kolomnya)
        $product = ModelProduct::find($product->product_id);
        // Mengubah path view menjadi 'admin.products.add_stock'
        return view('admin.products.add_stock', compact('product', 'user', 'productStock'));
    }

    public function storeAddStock(Request $request, ModelProduct $product)
    {
        // Validasi data
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Ambil data user yang login
        $user = Auth::user();
        $outletId = $user->outlet_id;
        $quantity = $request->input('quantity');

        // Cek apakah record stok untuk produk dan outlet sudah ada
        $productStock = ModelProductStock::where('product_id', $product->product_id)
            ->where('outlet_id', $outletId)
            ->first();

        // Simpan stok awal sebelum penambahan
        $stockSebelum = $productStock ? $productStock->stock : 0;

        // Update atau buat stock baru
        if ($productStock) {
            $productStock->stock += $quantity;
            $productStock->save();
        } else {
            $productStock = ModelProductStock::create([
                'product_id' => $product->product_id,
                'outlet_id' => $outletId,
                'stock' => $quantity
            ]);
        }

        // Log aktivitas penambahan stok
        ModelActivityLog::createLog(
            $user->user_id,
            $user->outlet_id,
            'ADD_STOCK',
            sprintf(
                "Penambahan stok | Produk: %s | Jumlah: +%d %s | " .
                "Stok Sebelum: %d | Stok Setelah: %d | " .
                "Operator: %s | Outlet: %s",
                $product->product_name,
                $quantity,
                $product->unit ?? 'unit',
                $stockSebelum,
                $productStock->stock,
                $user->username,
                $user->outlet->outlet_name
            )
        );

        $message = sprintf(
            'Stok produk %s berhasil ditambahkan sebanyak %d. Total stok saat ini: %d',
            $product->product_name,
            $quantity,
            $productStock->stock
        );

        return redirect()->route('products-all-outlets')->with('success', $message);
    }

    public function reduceStock(ModelProduct $product)
    {
        // Ambil user yang login
        $user = Auth::user();
        $outletId = $user->outlet_id;

        // Ambil data stok dari tabel product_stock
        $productStock = ModelProductStock::where('product_id', $product->product_id)
            ->where('outlet_id', $outletId)
            ->first();

        // Mengambil Data product (pastikan product sudah lengkap dengan semua kolomnya)
        $product = ModelProduct::find($product->product_id);

        // Pastikan data $productStock tidak null
        if (!$productStock) {
            $productStock = new ModelProductStock();
            $productStock->stock = 0;
        }

        return view('admin.products.reduce_stock', compact('product', 'user', 'productStock'));
    }


    public function storeReduceStock(Request $request, ModelProduct $product)
    {
        // Validasi data
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Ambil data user yang login
        $user = Auth::user();
        $outletId = $user->outlet_id;

        $quantity = $request->input('quantity');

        // Cek apakah record stok untuk produk dan outlet sudah ada
        $productStock = ModelProductStock::where('product_id', $product->product_id)
            ->where('outlet_id', $outletId)
            ->first();
        if (!$productStock) {
            $message = 'Stok produk ' . $product->product_name . ' gagal dikurangi, stok belum tersedia dioutlet ini!';
            return redirect()->route('self-products')->with('error', $message);
        }

        // Simpan stok awal sebelum pengurangan
        $stockSebelum = $productStock->stock;
        
        // Kurangi stok
        $productStock->stock -= $quantity;
        $productStock->save();

        // Log aktivitas pengurangan stok
        ModelActivityLog::createLog(
            $user->user_id,
            $user->outlet_id,
            'REDUCE_STOCK',
            sprintf(
                "Pengurangan stok | Produk: %s | Jumlah: -%d %s | " .
                "Stok Sebelum: %d | Stok Setelah: %d | " .
                "Operator: %s | Outlet: %s",
                $product->product_name,
                $quantity,
                $product->unit ?? 'unit',
                $stockSebelum,
                $productStock->stock,
                $user->username,
                $user->outlet->outlet_name
            )
        );

        $message = sprintf(
            'Stok produk %s berhasil dikurangi sebanyak %d. Total stok saat ini: %d',
            $product->product_name,
            $quantity,
            $productStock->stock
        );

        // Setelah mengurangi stok, cek apakah perlu membuat notifikasi
        $newStock = $productStock->stock;
        if ($newStock <= 0) {
            $this->checkAndCreateNotification($product, $newStock, 'critical');
        } elseif ($newStock <= $product->min_stock) {
            $this->checkAndCreateNotification($product, $newStock, 'low');
        }

        return redirect()->route('self-products')->with('success', $message);
    }

    public function transferStock(ModelProduct $product)
    {
        // ambil user yang login
        $user = Auth::user();
        $outletId = $user->outlet_id;

        // Ambil data stok dari tabel product_stock
        $productStock = ModelProductStock::where('product_id', $product->product_id)
            ->where('outlet_id', $outletId)
            ->first();

        // Pastikan data $productStock tidak null
        if (!$productStock) {
            $productStock = new ModelProductStock();
            $productStock->stock = 0;
        }

        //ambil outlet yang 1 group
        $outlets = ModelOutlet::where('outlet_group_id', $user->outlet->outlet_group_id)->where('outlet_id', '<>', $user->outlet_id)->get();

        return view('admin.products.transfer_stock', compact('product', 'user', 'outlets', 'productStock'));
    }
    public function storeTransferStock(Request $request, ModelProduct $product)
    {
        // Ambil data user yang login
        $user = Auth::user();
        $outletId = $user->outlet_id;

        // Ambil data stok dari tabel product_stock
        $productStock = ModelProductStock::where('product_id', $product->product_id)
            ->where('outlet_id', $outletId)
            ->first();

        // Validasi data
        $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' . ($productStock->stock ?? 0) // Gunakan stok dari product_stock
            ],
            'to_outlet_id' => ['required', 'exists:outlets,outlet_id'],
        ]);

        $quantity = $request->input('quantity');
        $toOutlet = ModelOutlet::find($request->input('to_outlet_id'));

        // Create transfer record
        $transit = ModelProductTransit::create([
            'product_id' => $product->product_id,
            'from_outlet_id' =>  $outletId,
            'to_outlet_id' => $request->input('to_outlet_id'),
            'user_id' => $user->user_id,
            'operator_sender' => $user->user_id,
            'has_serial_number' => 0,
            'quantity' => $quantity,
            'status' => 'transit'
        ]);

        // Update stock
        if ($productStock) {
            $productStock->stock -= $quantity;
            $productStock->save();
        }

        // Log the activity
        ModelActivityLog::createLog(
            $user->user_id,
            $user->outlet_id,
            'TRANSFER_STOCK',
            sprintf(
                "Transfer stok | Produk: %s | Jumlah: %d %s | Dari: %s | Ke: %s | Sisa Stok: %d",
                $product->product_name,
                $quantity,
                $product->unit ?? 'unit',
                $user->outlet->outlet_name,
                $toOutlet->outlet_name,
                $productStock->stock
            )
        );

        $message = sprintf(
            'Stok produk %s berhasil dipindahkan sebanyak %d dari outlet %s ke outlet %s. Sisa stok saat ini: %d',
            $product->product_name,
            $quantity,
            $user->outlet->outlet_name,
            $toOutlet->outlet_name,
            $productStock->stock ?? 0
        );

        return redirect()->route('products-all-outlets')->with('success', $message);
    }

    public function updateReduceUnit(Request $request, ModelProduct $product)
    {
        // ambil user yang login
        $user = Auth::user();
        $availableSerials = $product->serials()->where('status', 'available')->count();

        // Validasi data
        $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' . $availableSerials
            ]
        ]);
        //Update Status Serial Number
        $serialsToUpdate = $product->serials()->where('status', 'available')->take($request->input('quantity'))->get();
        foreach ($serialsToUpdate as $serial) {
            $serial->status = 'sold';
            $serial->save();
        }
        return redirect()->route('self-products')->with('success', 'Unit product reduced successfully!');
    }

    public function deleteSerial(ModelProductSerials $serial)
    {
        $serial->delete();
        return redirect()->back()->with('success', 'Serial number deleted successfully!');
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => [
                'required',
                Rule::unique('products')->where(function ($query) use ($request) {
                    return $query->where('outlet_id', $request->input('outlet_id'));
                })
            ],
            'brand' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'price_modal' => [
                'required',
                'numeric',
                'min:0'
            ],
            'price_grosir' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value <= $request->price_modal) {
                        $fail('Harga grosir harus lebih besar dari harga modal');
                    }
                }
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value <= $request->price_grosir) {
                        $fail('Harga ecer harus lebih besar dari harga grosir');
                    }
                }
            ],
            'unit' => 'nullable|string|max:50',
            'stock' => 'required_if:has_serial_number,==,0|integer|min:0',
            'has_serial_number' => 'required|boolean'
        ]);
        $user = Auth::user();
        DB::beginTransaction();
        try {
            // Ambil data dari request
            $productData = $request->except('_token', 'serial', 'stock');
            
            // Generate barcode for non-serial products
            if (!$request->has_serial_number) {
                do {
                    $barcode = 'BC' . mt_rand(10000000, 99999999);
                    $exists = ModelProduct::where('product_code', $barcode)->exists();
                } while ($exists);
                
                $productData['product_code'] = $barcode;
            }

            //jika produk tidak memiliki serial number
            if (!$request->has_serial_number) {
                $product = ModelProduct::create(array_merge($productData, ['user_id' => $user->user_id, 'outlet_id' =>  $user->outlet_id]));
                ModelProductStock::create([
                    'product_id' => $product->product_id,
                    'outlet_id' => $user->outlet_id,
                    'stock' => $request->input('stock')
                ]);
            } else {
                $product = ModelProduct::create(array_merge($productData, ['user_id' => $user->user_id, 'outlet_id' =>  $user->outlet_id]));
                //jika produk memiliki serial number maka simpan juga serial number
                if ($request->has('serial')) {
                    $serials = [];
                    foreach ($request->input('serial') as $serial) {
                        if ($serial != null) {
                            $serials[] = [
                                'product_id' => $product->product_id,
                                'serial_number' => $serial,
                                'user_id' => $user->user_id,
                                'outlet_id' => $user->outlet_id,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        }
                    }
                    ModelProductSerials::insert($serials);
                }
            }
            DB::commit();
            return redirect()->route('self-products')->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to add product. Error: ' . $e->getMessage());
        }
    }
    public function selfProducts()
    {
        $user = Auth::user();
        if (!$user) {
            Log::debug('Tidak ada user yang login');
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu!');
        }

        $outletId = $user->outlet_id;
        if (!$outletId) {
            Log::debug('User tidak memiliki outlet_id');
            return redirect('/dashboard')->with('error', 'User tidak memiliki outlet!');
        }

        $products = ModelProduct::with(['category', 'supplier', 'serials', 'productStock'])
            ->where('outlet_id', $outletId)
            ->get();

        Log::debug('Product count: ' . count($products));

        foreach ($products as $product) {
            Log::debug('Product ID: ' . $product->product_id);
            Log::debug('Product name: ' . $product->product_name);
            Log::debug('Serial count: ' . count($product->serials));
            foreach ($product->serials as $serial) {
                Log::debug('Serial number: ' . $serial->serial_number);
            }
        }

        return view('admin.products.self_product', compact('products'));
    }
    public function transferRequests()
    {
        $user = Auth::user();
        $transits = ModelProductTransit::with(['product', 'serial', 'fromOutlet', 'toOutlet', 'user', 'operatorSender'])
            ->where('to_outlet_id', $user->outlet_id)
            ->where('status', 'transit')
            ->get();
        return view('admin.products.transfer_requests', compact('transits'));
    }
    public function historyTransferRequests()
    {
        $user = Auth::user();
        Log::debug('User ID :' .  $user->user_id ?? 'user id null');
        Log::debug('Outlet ID :' . $user->outlet_id ?? 'outlet id null');
        $transits = ModelProductTransit::with(['product', 'serial', 'fromOutlet', 'toOutlet', 'user', 'operatorSender'])
            ->where('from_outlet_id', $user->outlet_id)
            ->where('status', 'transit')
            ->get();
        Log::debug('Transit count: ' . count($transits));
        foreach ($transits as $transit) {
            Log::debug('Transit ID: ' . $transit->transit_id);
            Log::debug('Product ID: ' . $transit->product_id);
            Log::debug('Status: ' . $transit->status);
            if ($transit->serial) {
                Log::debug('Serial ID: ' . $transit->serial->serial_id);
                Log::debug('Serial Number: ' . $transit->serial->serial_number);
            }
        }
        return view('admin.products.history_transfer_requests', compact('transits'));
    }
    public function approveTransfer(ModelProductTransit $transit)
    {
        // ambil user yang login
        $user = Auth::user();
        Log::debug('Transit ID:' . $transit->transit_id);
        Log::debug('Product ID:' . $transit->product_id);
        Log::debug('From Outlet ID:' . $transit->from_outlet_id);
        Log::debug('To Outlet ID:' . $transit->to_outlet_id);
        Log::debug('Quantity:' . $transit->quantity);
        Log::debug('Has Serial Number:' . $transit->has_serial_number);

        //ubah status menjadi received
        $transit->status = 'received';
        $transit->operator_receiver = $user->user_id;
        $transit->save();
        if ($transit->has_serial_number) {
            $serial = $transit->serial;
            $serial->status = 'available';
            $serial->outlet_id = $transit->to_outlet_id;
            $serial->save();
            Log::debug('Serial Status :' .  $serial->status);
            Log::debug('Serial Outlet :' .  $serial->outlet_id);
        } else {
            $product = $transit->product;

            //cari data product stock berdasarkan outlet_id dan product_id, jika tidak ada create record baru
            $productStockReceiver = ModelProductStock::where('product_id', $transit->product_id)
                ->where('outlet_id', $transit->to_outlet_id)
                ->first();

            if (!$productStockReceiver) {
                $productStockReceiver = new ModelProductStock();
                $productStockReceiver->product_id = $transit->product_id;
                $productStockReceiver->outlet_id = $transit->to_outlet_id;
                $productStockReceiver->stock = $transit->quantity;
                $productStockReceiver->save();            } else {
                    $productStockReceiver->stock += $transit->quantity;
                    $productStockReceiver->save();
                }
    
                Log::debug('Product Stock :' .  $productStockReceiver->stock);
                Log::debug('Product Outlet :' .  $productStockReceiver->outlet_id);
            }
            return redirect()->back()->with('success', 'Permintaan pemindahan produk disetujui');
        }
    
        public function rejectTransfer(ModelProductTransit $transit)
        {
            //ubah status menjadi rejected
            $transit->status = 'rejected';
            $transit->save();
    
    
            if ($transit->has_serial_number) {
                $serial = $transit->serial;
                $serial->status = 'available';
                $serial->outlet_id = $transit->from_outlet_id;
                $serial->save();
                Log::debug('Serial Status :' .  $serial->status);
                Log::debug('Serial Outlet :' .  $serial->outlet_id);
            } else {
                // Mendapatkan product stock penerima
                $productStockReceiver = ModelProductStock::where('product_id', $transit->product_id)
                    ->where('outlet_id', $transit->to_outlet_id)
                    ->first();
    
    
                //Mendapatkan product stock pengirim
                $productStockSender = ModelProductStock::where('product_id', $transit->product_id)
                    ->where('outlet_id', $transit->from_outlet_id)
                    ->first();
    
    
                if ($productStockReceiver) {
                    $productStockReceiver->stock -= $transit->quantity;
                    $productStockReceiver->save();
                }
                if ($productStockSender) {
                    $productStockSender->stock += $transit->quantity;
                    $productStockSender->save();
                }
    
                Log::debug('Product Stock Receiver :' .  $productStockReceiver->stock);
                Log::debug('Product Stock Sender :' .  $productStockSender->stock);
            }
    
            return redirect()->back()->with('success', 'Permintaan pemindahan produk ditolak dan stok dikembalikan ke outlet pengirim.');
        }
            public function transferRequestsSubmission()
        {
            // Ambil user yang login
            $user = Auth::user();
            $outletId = $user->outlet_id;
            
            // Ambil semua pengajuan transfer yang dibuat oleh outlet yang login
            $transits = ModelProductTransit::with(['product','toOutlet', 'operatorSender', 'operatorReceiver','serial'])
                ->where('from_outlet_id', $outletId)
                ->orderBy('created_at', 'desc')
                ->get();
    
    
            return view('admin.products.transfer_requests_submission', compact('transits', 'user'));
        }
    
        public function cancelTransfer(ModelProductTransit $transit)
        {
            if ($transit->status !== 'transit') {
                return redirect()->back()->with('error', 'Hanya pengajuan dengan status transit yang dapat dibatalkan.');
            }
        
            $user = Auth::user();
        
            // Log the cancellation activity
            ModelActivityLog::createLog(
                $user->user_id,
                $user->outlet_id,
                'CANCEL_TRANSFER',
                sprintf(
                    "Pembatalan transfer stok | Produk: %s | Jumlah: %d | Dari: %s | Ke: %s | %s",
                    $transit->product->product_name,
                    $transit->quantity ?? 1,
                    $transit->fromOutlet->outlet_name,
                    $transit->toOutlet->outlet_name,
                    $transit->has_serial_number ? 
                        "Serial: " . ($transit->serial?->serial_number ?? 'N/A') : 
                        "Non-Serial"
                )
            );
        
            // Return stock/serial to original outlet
            if ($transit->has_serial_number) {
                $serial = $transit->serial;
                if ($serial) {
                    $serial->status = 'available';
                    $serial->outlet_id = $transit->from_outlet_id;
                    $serial->save();
                }
            } else {
                // Return non-serial product stock
                $productStock = ModelProductStock::where('product_id', $transit->product_id)
                    ->where('outlet_id', $transit->from_outlet_id)
                    ->first();
                    
                if ($productStock) {
                    $productStock->stock += $transit->quantity;
                    $productStock->save();
                }
            }
        
            // Delete the transit record
            $transit->delete();
        
            return redirect()->route('products.transfer-requests-submission')
                ->with('success', 'Pengajuan pemindahan stok berhasil dibatalkan.');
        }
    
        public function getDailyProductCount($outletGroupId)
        {
            return ModelProduct::getTodayProductCount($outletGroupId);
        }
    
        // ... (other methods) ...
    
    public function lowStock()
    {
        $user = Auth::user();
        $outlet = $user->outlet;
    
        // Check if outlet has low stock reminder feature
        if (!$outlet->membership->low_stock_reminder_feature) {
            return redirect()->back()->with('error', 'Fitur pengingat stok tidak tersedia untuk membership Anda.');
        }
    
        // Get products with serial numbers
        $serialProducts = ModelProduct::with(['serials'])
            ->where('outlet_id', $outlet->outlet_id)
            ->where('has_serial_number', true)
            ->get()
            ->map(function($product) {
                $availableCount = $product->serials()->where('status', 'tersedia')->count();
                return [
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'type' => 'serial',
                    'available_stock' => $availableCount,
                    'min_stock' => $product->min_stock,
                    'status' => $this->getStockStatus($availableCount, $product->min_stock)
                ];
            });
    
        // Get products without serial numbers
        $nonSerialProducts = ModelProduct::with(['productStock'])
            ->where('outlet_id', $outlet->outlet_id)
            ->where('has_serial_number', false)
            ->get()
            ->map(function($product) {
                $stock = $product->productStock->first();
                $currentStock = $stock ? $stock->stock : 0;
                return [
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'type' => 'non-serial',
                    'available_stock' => $currentStock,
                    'min_stock' => $product->min_stock,
                    'status' => $this->getStockStatus($currentStock, $product->min_stock)
                ];
            });
    
        $products = $serialProducts->concat($nonSerialProducts)
                                 ->filter(function($product) {
                                     return $product['status'] !== 'normal';
                                 })
                                 ->sortBy('available_stock');
    
        return view('admin.products.low_stock', compact('products'));
    }
    
    private function getStockStatus($currentStock, $minStock)
    {
        if ($currentStock <= 0) {
            return 'critical';
        } elseif ($currentStock <= $minStock) {
            return 'low';
        }
        return 'normal';
    }
    
    public function updateMinStock(Request $request, ModelProduct $product)
    {
        $request->validate([
            'min_stock' => 'required|integer|min:0'
        ]);
    
        $product->min_stock = $request->min_stock;
        $product->save();
    
        return redirect()->back()->with('success', 'Batas minimum stok berhasil diperbarui');
    }

    private function checkAndCreateNotification($product, $currentStock, $status)
    {
        // Hanya buat notifikasi jika outlet memiliki fitur low stock reminder
        if (!$product->outlet->membership->low_stock_reminder_feature) {
            return;
        }

        $message = sprintf(
            'Stok produk %s %s (tersisa %d dari minimum %d)',
            $product->product_name,
            $status === 'critical' ? 'sudah habis' : 'hampir habis',
            $currentStock,
            $product->min_stock
        );

        StockNotification::create([
            'outlet_id' => $product->outlet_id,
            'product_id' => $product->product_id,
            'status' => $status,
            'message' => $message
        ]);
    }

    // Tambahkan method untuk mengambil notifikasi
    public function getNotifications()
    {
        $user = Auth::user();
        $notifications = StockNotification::where('outlet_id', $user->outlet_id)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json($notifications);
    }

    // Method untuk menandai notifikasi sudah dibaca
    public function markNotificationAsRead($id)
    {
        $notification = StockNotification::find($id);
        if ($notification) {
            $notification->is_read = true;
            $notification->save();
        }
        return response()->json(['success' => true]);
    }
}