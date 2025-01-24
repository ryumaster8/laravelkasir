<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\ModelUser;
use App\Models\Membership;
use App\Models\ModelRoles;
use App\Models\ModelOutlet;
use App\Models\ModelProduct;
use Illuminate\Http\Request;
use App\Models\ModelMembership;
use App\Models\ModelProductStock;
use App\Models\ModelRekeningOwner;
use Illuminate\Support\Facades\DB;
use App\Models\ModelProductSerials;
use App\Models\ModelUserPermission;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModelOutletGroup; // Tambahkan ModelOutletGroup
use Illuminate\Support\Facades\Validator; // Import class Validator
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\ModelCategories; // Update this import
use App\Models\ModelSuppliers; // Update this import

class ProductOutletsController extends Controller
{
    public function index()
    {
        // ambil user yang login
        $user = Auth::user();
        //ambil semua produk dari outlet yang sedang login berdasarkan group id
        $products = ModelProduct::with(['category', 'supplier', 'serials' => function ($query) use ($user) {
            $query->where('outlet_id', $user->outlet_id)->where('status', 'available');
        }])
            ->whereHas('outlet', function ($query) use ($user) {
                $query->where('outlet_group_id', $user->outlet->outlet_group_id);
            })
            ->paginate(10); // Mengubah get() menjadi paginate()

        foreach ($products as $product) {
            if (!$product->has_serial_number) {
                $productStock = ModelProductStock::where('product_id', $product->product_id)->where('outlet_id', $user->outlet_id)->first();
                $product->stock = $productStock->stock ?? 0;
            }
        }
        return view('admin.products_outlet.index', compact('products'));
    }

    public function addSerial($id)
    {
        $product = ModelProduct::findOrFail($id);
        return view('admin.products_outlet.add_serial', compact('product'));
    }

    public function storeSerial(Request $request, $id)
    {
        $product = ModelProduct::findOrFail($id);
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'serial_numbers' => 'required|array',
            'serial_numbers.*' => 'required|string|unique:product_serials,serial_number'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            foreach ($request->serial_numbers as $serialNumber) {
                ModelProductSerials::create([
                    'product_id' => $id,
                    'outlet_id' => $user->outlet_id,
                    'serial_number' => $serialNumber,
                    'status' => 'available'
                ]);
            }
            DB::commit();
            return redirect()->route('products-outlet.index')->with('success', 'Serial number berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan serial number');
        }
    }

    public function addStock($id)
    {
        $product = ModelProduct::findOrFail($id);
        return view('admin.products_outlet.add_stock', compact('product'));
    }

    public function storeStock(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        $stock = ModelProductStock::firstOrCreate(
            ['product_id' => $id, 'outlet_id' => $user->outlet_id],
            ['stock' => 0]
        );

        DB::beginTransaction();
        try {
            $stock->increment('stock', $request->quantity);
            DB::commit();
            return redirect()->route('products-outlet.index')->with('success', 'Stok berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan stok');
        }
    }

    public function edit($id)
    {
        $product = ModelProduct::findOrFail($id);
        $categories = ModelCategories::all(); // Update model name
        $suppliers = ModelSuppliers::all(); // Update model name
        $user = Auth::user();

        return view('admin.products.edit_self_product', compact('product', 'categories', 'suppliers', 'user'));
    }
}
