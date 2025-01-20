<?php

namespace App\Http\Controllers;

use App\Models\ModelOutlet;
use App\Models\ModelProduct;
use Illuminate\Http\Request;
use App\Models\ModelProducts;
use App\Models\ModelSuppliers;
use App\Models\ModelCategories;
use App\Models\ModelProductStock;
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
        $availableSerials = $product->serials()->where('status', 'available')->count();

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
            ->where('status', 'available')
            ->get();


        return view('admin.products.transfer_unit', compact('product', 'user', 'outlets', 'serials'));
    }
    public function storeTransferUnit(Request $request, ModelProduct $product)
    {
        // Validasi data
        $request->validate([
            'to_outlet_id' => ['required', 'exists:outlets,outlet_id'],
            'selected_serials' => 'required|array|min:1'
        ]);
        $selectedSerials = $request->input('selected_serials');

        // ambil user yang login
        $user = Auth::user();
        $fromOutletId = $user->outlet_id;


        $transits = [];
        // simpan data pindah unit untuk setiap serial yang dipilih
        foreach ($selectedSerials as $serialId) {
            $serial =  ModelProductSerials::find($serialId);
            // Simpan data pada tabel product_transits
            $transit = ModelProductTransit::create([
                'product_id' => $product->product_id,
                'serial_id' => $serial->serial_id,
                'from_outlet_id' => $fromOutletId,
                'to_outlet_id' => $request->input('to_outlet_id'),
                'user_id' => Auth::user()->user_id,
                'operator_sender' => Auth::user()->user_id,
                'has_serial_number' => 1,
                'status' => 'transit'
            ]);
            //update status serial number menjadi transit
            $serial->status = 'transit';
            $serial->save();
            $transits[] = $transit;
        }
        return view('admin.products.transfer_confirmation', compact('transits', 'user', 'product'));
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

        // Jika record stok sudah ada, update stoknya
        if ($productStock) {
            $productStock->stock += $quantity;
            $productStock->save();
            // Jika record stok belum ada, buat record baru
        } else {
            $productStock = new ModelProductStock();
            $productStock->product_id = $product->product_id;
            $productStock->outlet_id = $outletId;
            $productStock->stock = $quantity;
            $productStock->save();
        }

        $message = 'Stok produk ' . $product->product_name . ' berhasil ditambahkan sebanyak ' . $quantity . '. Total stok saat ini: ' . $productStock->stock;
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
        } else {
            // Jika record stok sudah ada, kurangi stoknya
            $productStock->stock -= $quantity;
            $productStock->save();
        }
        $message = 'Stok produk ' . $product->product_name . ' berhasil dikurangi sebanyak ' . $quantity . '. Total stok saat ini: ' . $productStock->stock;
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


        // Simpan data pada tabel product_transits
        ModelProductTransit::create([
            'product_id' => $product->product_id,
            'from_outlet_id' =>  $outletId,
            'to_outlet_id' => $request->input('to_outlet_id'),
            'user_id' => Auth::user()->user_id,
            'operator_sender' => Auth::user()->user_id,
            'has_serial_number' => 0,
            'quantity' => $quantity,
            'status' => 'transit'
        ]);


        //Update Data Stok (Pengirim)
        if ($productStock) {
            $productStock->stock -= $quantity;
            $productStock->save();
        }


        $message = 'Stok produk ' . $product->product_name . ' berhasil dipindahkan sebanyak ' . $quantity . ' dari outlet ' . $user->outlet->outlet_name .  ' ke outlet ' . ModelOutlet::find($request->input('to_outlet_id'))->outlet_name .  '. Sisa stok saat ini: ' . ($productStock->stock ?? 0);
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
            'price_modal' => 'required|numeric|min:0',
            'price_grosir' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'stock' => 'required_if:has_serial_number,==,0|integer|min:0',
            'has_serial_number' => 'required|boolean'
        ]);
        $user = Auth::user();
        DB::beginTransaction();
        try {
            // Ambil data dari request
            $productData = $request->except('_token', 'serial', 'stock');
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
            return redirect()->route('products-all-outlets')->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to add product. Error: ' . $e->getMessage());
        }
    }
    public function selfProducts()
    {
        // Ambil user yang sedang login
        $user = Auth::user();
        // dd($user);

        // Pastikan user sudah login
        if (!$user) {
            Log::debug('Tidak ada user yang login');
            // Tambahkan kode untuk redirect atau return error message
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu!');
        }

        // Ambil outlet ID dari user
        $outletId = $user->outlet_id;

        if (!$outletId) {
            Log::debug('User tidak memiliki outlet_id');
            // Tambahkan kode untuk redirect atau return error message
            return redirect('/dashboard')->with('error', 'User tidak memiliki outlet!');
        }

        Log::debug('User ID: ' . $user->id);
        Log::debug('Outlet ID: ' . $outletId);


        // Ambil semua produk dari outlet yang sedang login
        $products = ModelProduct::with(['category', 'supplier', 'serials'])
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
                $productStockReceiver->save();
            } else {
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
        $transits = ModelProductTransit::with(['product', 'toOutlet', 'operatorSender', 'operatorReceiver', 'serial'])
            ->where('from_outlet_id', $outletId)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('admin.products.transfer_requests_submission', compact('transits', 'user'));
    }
}
