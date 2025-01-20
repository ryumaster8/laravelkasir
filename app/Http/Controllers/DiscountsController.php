<?php

namespace App\Http\Controllers;

use App\Models\ModelCategories;
use App\Models\ModelProduct;
use Illuminate\Http\Request;
use App\Models\ModelDiscount;

class DiscountsController extends Controller
{
    public function index()
    {
        $discounts = ModelDiscount::with(['category', 'product'])->get();
        return view('admin.discounts.index', compact('discounts'));
    }

    public function create()
    {
        // Ambil semua produk dan kategori
        $products = ModelProduct::select('product_id', 'product_name')->get();
        $categories = ModelCategories::select('category_id', 'category_name')->get();

        return view('admin.discounts.create', compact('products', 'categories'));
    }
    /**
     * Simpan data diskon baru.
     */
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'discount_name' => 'required|string|max:255',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'applies_to' => 'required|in:product,category',
            'product_id' => 'required_if:applies_to,product|exists:products,product_id',
            'category_id' => 'required_if:applies_to,category|exists:categories,category_id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Tentukan Data untuk Disimpan
        $data = [
            'discount_name' => $request->discount_name,
            'type' => $request->type,
            'value' => $request->value,
            'applies_to' => $request->applies_to,
            'product_id' => $request->applies_to === 'product' ? $request->product_id : null,
            'category_id' => $request->applies_to === 'category' ? $request->category_id : null,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'discount_operator_id' => session('user_id'), // Ambil user ID dari session
            'discount_outlet_id' => session('outlet_id'), // Ambil outlet ID dari session
        ];

        // Simpan ke Database
        ModelDiscount::create($data);

        return redirect()->route('discounts.index')->with('success', 'Diskon berhasil ditambahkan.');
    }
    public function toggle($id)
    {
        $discount = ModelDiscount::findOrFail($id);
        $discount->is_active = !$discount->is_active;
        $discount->save();

        return redirect()->route('discounts.index')->with('success', 'Status diskon berhasil diubah.');
    }

    public function show($id)
    {
        $discount = ModelDiscount::with(['category', 'product'])->findOrFail($id);
        return view('admin.discounts.show', compact('discount'));
    }
    public function edit($id)
    {
        $discount = ModelDiscount::findOrFail($id);
        $categories = ModelCategories::all(); // Semua kategori
        $products = ModelProduct::all(); // Semua produk

        return view('admin.discounts.edit', compact('discount', 'categories', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'discount_name' => 'required|string|max:255',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'applies_to' => 'required|in:product,category',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'product_id' => 'nullable|exists:products,product_id',
            'category_id' => 'nullable|exists:categories,category_id',
        ]);

        $discount = ModelDiscount::findOrFail($id);

        $discount->update([
            'discount_name' => $request->discount_name,
            'type' => $request->type,
            'value' => $request->value,
            'applies_to' => $request->applies_to,
            'product_id' => $request->applies_to === 'product' ? $request->product_id : null,
            'category_id' => $request->applies_to === 'category' ? $request->category_id : null,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('discounts.index')->with('success', 'Diskon berhasil diperbarui.');
    }
    public function applyProduct()
    {
        // Ambil produk yang mendapatkan diskon aktif
        $productsWithDiscount = ModelDiscount::where('is_active', 1)
            ->where('applies_to', 'product')
            ->with('product') // Relasi dengan produk
            ->get();

        return view('admin.discounts.apply_product', compact('productsWithDiscount'));
    }
    public function applyCategory()
    {
        // Ambil diskon aktif berdasarkan kategori
        $categoriesWithDiscount = ModelDiscount::where('is_active', 1)
            ->where('applies_to', 'category')
            ->with('category.products') // Relasi kategori dengan produk
            ->get();

        return view('admin.discounts.apply_category', compact('categoriesWithDiscount'));
    }


    public function form($id = null)
    {
        $discount = $id ? ModelDiscount::findOrFail($id) : null;
        $categories = ModelCategories::all(); // Semua kategori
        $products = ModelProduct::all(); // Semua produk

        return view('admin.discounts.form', compact('discount', 'categories', 'products'));
    }

    public function save(Request $request, $id = null)
    {
        $request->validate([
            'discount_name' => 'required|string|max:255',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'applies_to' => 'required|in:product,category',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'product_id' => 'nullable|exists:products,product_id',
            'category_id' => 'nullable|exists:categories,category_id',
        ]);

        $data = [
            'discount_name' => $request->discount_name,
            'type' => $request->type,
            'value' => $request->value,
            'applies_to' => $request->applies_to,
            'product_id' => $request->applies_to === 'product' ? $request->product_id : null,
            'category_id' => $request->applies_to === 'category' ? $request->category_id : null,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        if ($id) {
            // Update
            $discount = ModelDiscount::findOrFail($id);
            $discount->update($data);
            $message = 'Diskon berhasil diperbarui.';
        } else {
            // Create
            ModelDiscount::create($data);
            $message = 'Diskon berhasil ditambahkan.';
        }

        return redirect()->route('discounts.index')->with('success', $message);
    }
}
