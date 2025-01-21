public function search(Request $request)
{
    $term = $request->get('term');
    $products = ModelProduct::where('outlet_id', auth()->user()->outlet_id)
        ->where('product_name', 'LIKE', "%{$term}%")
        ->with(['productStock', 'serials'])
        ->get()
        ->map(function($product) {
            $stock = $product->productStock->sum('stock');
            $serialCount = $product->serials->count();
            $totalStock = $product->has_serial_number ? $serialCount : $stock;
            
            return [
                'product_id' => $product->product_id,
                'product_name' => $product->product_name,
                'stock_total' => $totalStock,
                'is_serial' => $product->has_serial_number
            ];
        });

    return response()->json($products);
}
