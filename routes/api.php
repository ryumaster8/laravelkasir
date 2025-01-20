// ...existing code...

Route::get('/banks/active', function (Request $request) {
    return ModelBank::getActiveByOutlet(session('outlet_id'));
});
