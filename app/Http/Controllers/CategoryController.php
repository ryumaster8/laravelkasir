public function search(Request $request)
{
    $term = $request->get('term');
    $categories = ModelCategories::where('outlet_id', auth()->user()->outlet_id)
        ->where('category_name', 'LIKE', "%{$term}%")
        ->get(['category_id', 'category_name']);

    return response()->json($categories);
}
