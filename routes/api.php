// ...existing code...

Route::get('/banks/active', function (Request $request) {
    return ModelBank::getActiveByOutlet(session('outlet_id'));
});

Route::get('/products/search', [ProductController::class, 'search']);
Route::get('/categories/search', [CategoryController::class, 'search']);
