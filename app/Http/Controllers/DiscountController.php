public function create()
{
    $products = ModelProduct::where('outlet_id', auth()->user()->outlet_id)
                          ->with(['productStock', 'serials'])
                          ->get();
                          
    $categories = ModelCategories::where('outlet_id', auth()->user()->outlet_id)
                               ->get();

    $discount = null; // Explicitly set to null for create form

    return view('admin.discounts.form', compact('products', 'categories', 'discount'));
}

public function edit($id)
{
    $discount = ModelDiscount::with(['products', 'categories'])->findOrFail($id);
    
    $products = ModelProduct::where('outlet_id', auth()->user()->outlet_id)
                          ->with(['productStock', 'serials'])
                          ->get();
                          
    $categories = ModelCategories::where('outlet_id', auth()->user()->outlet_id)
                               ->get();

    return view('admin.discounts.form', compact('discount', 'products', 'categories'));
}
