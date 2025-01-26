<?php

use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRetailType;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\SaranController;
use App\Http\Controllers\BranchController;
//use test remoteadsdd

use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductOutletsController;
use App\Http\Controllers\UserPermissionsController;
use App\Http\Controllers\WholesaleCustomersController;
use App\Http\Controllers\PaymentConfirmationController;
use App\Http\Controllers\MembershipChangeRequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ContactController; // Tambahkan import ContactController

// Front Pages Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/features', [FrontController::class, 'features'])->name('features');
Route::get('/membership/details', [FrontController::class, 'membershipDetails'])->name('membership.details');
Route::get('/testimonials', [FrontController::class, 'testimonials'])->name('testimonials');
Route::get('/contact', [ContactController::class, 'show'])->name('contact'); // Gunakan ContactController@show
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store'); // Gunakan ContactController@store

// Autentikasi
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/doLogin', [AuthController::class, 'doLogin']);
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/auth/register', [AuthController::class, 'register'])->name('register');
Route::post('/auth/register', [AuthController::class, 'processRegister'])->name('process-register'); // Add this line
Route::get('/confirm-payment/{user_id}', [PaymentConfirmationController::class, 'confirmPayment'])->name('confirm.payment');
Route::post('/confirm-payment/{user_id}', [PaymentConfirmationController::class, 'processConfirmPayment'])->name('process.confirm.payment');
Route::get('/confirm-payment-success', [PaymentConfirmationController::class, 'confirmPaymentSuccess'])->name('confirm.payment.success');
Route::get('/clear', [AuthController::class, 'clearTables']);

// Tema & Tampilan
Route::get('/dashboard/settings/themse', [SettingsController::class, 'theme'])->name('settings.theme');
// Privasi
Route::get('/dashboard/settings/privacy', [SettingsController::class, 'privacy'])->name('settings.privacy');
// Dashboard Kustomisasi
Route::get('/dashboard/settings/dashboard-customization', [SettingsController::class, 'dashboardCustomization'])->name('settings.dashboard-customization');
// Pengaturan Hak Akses
Route::get('/dashboard/settings/access-control', [SettingsController::class, 'accessControl'])->name('settings.access-control');
// Keamanan
Route::get('/dashboard/settings/security', [SettingsController::class, 'security'])->name('settings.security');


//Manajemen User Permissions
Route::get('dashboard/user-permissions', [UserPermissionsController::class, 'index'])->name('user-permissions.index');
Route::get('dashboard/user-permissions/create', [UserPermissionsController::class, 'create'])->name('user-permissions.create');
Route::post('dashboard/user-permissions', [UserPermissionsController::class, 'store'])->name('user-permissions.store');
Route::get('dashboard/user-permissions/edit/{id}', [UserPermissionsController::class, 'edit'])->name('user-permissions.edit');
Route::put('dashboard/user-permissions/update/{id}', [UserPermissionsController::class, 'update'])->name('user-permissions.update');
Route::delete('dashboard/user-permissions/delete/{id}', [UserPermissionsController::class, 'destroy'])->name('user-permissions.destroy');

//Manajemen Pengguna
Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('user.create');
Route::post('/dashboard/users/create', [UserController::class, 'store'])->name('user.store');
Route::get('/dashboard/users', [UserController::class, 'index'])->name('user.index');
Route::get('/dashboard/users/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/dashboard/users/update/{user}', [UserController::class, 'update'])->name('user.update');
Route::get('/dashboard/users/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');

//Manajemen Kasir
Route::prefix('kasir')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [KasirController::class, 'index']);
    Route::get('/select-wholesale-customer', [KasirController::class, 'selectWholesaleCustomer'])->name('kasir.select-customer');
    Route::get('/grosir/{customer_id}', [KasirController::class, 'grosir'])->name('kasir.grosir');
    Route::get('/ecer', [KasirController::class, 'ecer'])->name('kasir.ecer');
    
    // API Endpoints
    Route::get('/search-products', [KasirController::class, 'searchProducts']);
    Route::get('/get-product/{id}', [KasirController::class, 'getProduct']);
    Route::get('/get-product-by-barcode/{barcode}', [KasirController::class, 'getProductByBarcode']);
    
    // Hold Transaction Routes
    Route::post('/hold-transaction', [TransactionController::class, 'holdTransaction']);
    Route::get('/held-transactions', [TransactionController::class, 'getHeldTransactions'])->name('kasir.held-transactions');
    Route::get('/held-transaction/{id}', [TransactionController::class, 'getHeldTransaction']);
    Route::delete('/held-transaction/{id}', [TransactionController::class, 'deleteHeldTransaction']);
    
    Route::post('/process-payment', [TransactionController::class, 'processPayment']);
    Route::post('/process-payment', [PaymentController::class, 'processPayment']);
    Route::get('/receipt/{id}', [PaymentController::class, 'getReceipt'])->name('receipt.print');
    Route::get('/get-discount/{productId}', [PaymentController::class, 'getDiscount']);
    Route::post('/kasir/process-payment', [PaymentController::class, 'processPayment'])->name('kasir.process-payment');
});

//Manajemen Cabang
Route::get('/dashboard/branches', [BranchController::class, 'index'])->name('branches.index');
Route::get('/dashboard/branches/create', [BranchController::class, 'create'])->name('branches.create'); 
Route::post('/dashboard/branches', [BranchController::class, 'store'])->name('branches.store');
Route::get('/dashboard/branches/{outlet}/edit', [BranchController::class, 'edit'])->name('branches.edit');
Route::delete('/dashboard/branches/{outlet}', [BranchController::class, 'destroy'])->name('branches.destroy');
Route::put('/dashboard/branches/{outlet}', [BranchController::class, 'update'])->name('branches.update');

// Manajemen Kategori
Route::get('/dashboard/categories', [CategoriesController::class, 'create'])->name('categories.index');
Route::get('/dashboard/categories/data', [CategoriesController::class, 'data'])->name('categories.data'); 
Route::get('/dashboard/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
Route::get('/dashboard/categories/{id}/delete', [CategoriesController::class, 'destroy'])->name('categories.delete');
Route::post('/dashboard/categories', [CategoriesController::class, 'store'])->name('categories.store');
Route::put('/dashboard/categories/{id}', [CategoriesController::class, 'update'])->name('categories.update');
Route::get('/dashboard/categories/set-default', [CategoriesController::class, 'setDefault'])->name('categories.set-default');

// Manajemen Supplier
Route::prefix('dashboard/suppliers')->group(function () {
    Route::get('/add', [SuppliersController::class, 'index'])->name('suppliers.index');
    Route::post('/add', [SuppliersController::class, 'store'])->name('suppliers.store');
    Route::get('/{id}/edit', [SuppliersController::class, 'edit'])->name('suppliers.edit');
    Route::put('/{id}', [SuppliersController::class, 'update'])->name('suppliers.update');
    Route::delete('/{id}', [SuppliersController::class, 'destroy'])->name('suppliers.delete');
    Route::get('/', [SuppliersController::class, 'list'])->name('suppliers.list');
});

// Manajemen Produk
Route::get('/dashboard/products-all-outlets', [ProductOutletsController::class, 'index'])->name('products-all-outlets');
Route::get('/dashboard/products/add', [ProductsController::class, 'create'])->name('products.index');
Route::post('/dashboard/products', [ProductsController::class, 'store'])->name('products.store');
Route::get('/dashboard/self-products', [ProductsController::class, 'selfProducts'])->name('self-products');
Route::get('/dashboard/self-products/{product}/edit', [ProductsController::class, 'edit'])->name('self-products.edit');
Route::put('/dashboard/self-products/{product}', [ProductsController::class, 'update'])->name('self-products.update');
Route::get('/dashboard/products/self-data', [ProductsController::class, 'dataSelfProducts'])->name('products.dataSelfProducts');
Route::get('/dashboard/self-products/{product}/edit-non-serial', [ProductsController::class, 'editNonSerial'])->name('self-products.edit-non-serial');
Route::put('/dashboard/self-products/{product}/update-non-serial', [ProductsController::class, 'updateNonSerial'])->name('self-products.update-non-serial');
Route::get('/dashboard/self-products/{product}/add-serial', [ProductsController::class, 'addSerial'])->name('self-products.add-serial');
Route::post('/dashboard/self-products/{product}/store-serial', [ProductsController::class, 'storeSerial'])->name('self-products.store-serial');
Route::get('/dashboard/self-products/delete-serial/{serial}', [ProductsController::class, 'deleteSerial'])->name('self-products.delete-serial');
Route::get('/dashboard/self-products/{product}/reduce-unit', [ProductsController::class, 'reduceUnit'])->name('self-products.reduce-unit');
Route::post('/dashboard/self-products/{product}/update-reduce-unit', [ProductsController::class, 'updateReduceUnit'])->name('self-products.update-reduce-unit');
Route::get('/dashboard/self-products/{product}/transfer-unit', [ProductsController::class, 'transferUnit'])->name('self-products.transfer-unit');
Route::post('/dashboard/self-products/{product}/store-transfer-unit', [ProductsController::class, 'storeTransferUnit'])->name('self-products.store-transfer-unit');
Route::get('/dashboard/self-products/{product}/add-stock', [ProductsController::class, 'addStock'])->name('self-products.add-stock');
Route::post('/dashboard/self-products/{product}/store-add-stock', [ProductsController::class, 'storeAddStock'])->name('self-products.store-add-stock');
Route::get('/dashboard/self-products/{product}/reduce-stock', [ProductsController::class, 'reduceStock'])->name('self-products.reduce-stock');
Route::post('/dashboard/self-products/{product}/store-reduce-stock', [ProductsController::class, 'storeReduceStock'])->name('self-products.store-reduce-stock');
Route::get('/dashboard/self-products/{product}/transfer-stock', [ProductsController::class, 'transferStock'])->name('self-products.transfer-stock');
Route::post('/dashboard/self-products/{product}/store-transfer-stock', [ProductsController::class, 'storeTransferStock'])->name('self-products.store-transfer-stock');
Route::get('/dashboard/products/transfer-requests', [ProductsController::class, 'transferRequests'])->name('products.transfer-requests');
Route::get('/dashboard/products/history-transfer-requests', [ProductsController::class, 'historyTransferRequests'])->name('products.history-transfer-requests');
Route::get('/dashboard/products/approve-transfer/{transit}', [ProductsController::class, 'approveTransfer'])->name('products.approve-transfer');
Route::get('/dashboard/products/reject-transfer/{transit}', [ProductsController::class, 'rejectTransfer'])->name('products.reject-transfer');
Route::get('/dashboard/products/submission-transfer-requests', [ProductsController::class, 'transferRequestsSubmission'])->name('products.transfer-requests-submission');

//Manajemen Pelanggan Grosir
Route::get('/dashboard/wholesale-customer', [WholesaleCustomersController::class, 'index'])->name('wholesale-customer.index');
Route::get('/dashboard/wholesale-customer/create', [WholesaleCustomersController::class, 'create'])->name('wholesale-customer.create');
Route::post('/dashboard/wholesale-customer', [WholesaleCustomersController::class, 'store'])->name('wholesale-customer.store');
Route::get('/dashboard/wholesale-customer/{id}/edit', [WholesaleCustomersController::class, 'edit'])->name('wholesale-customer.edit');
Route::put('/dashboard/wholesale-customer/{id}', [WholesaleCustomersController::class, 'update'])->name('wholesale-customer.update');
Route::delete('/dashboard/wholesale-customer/{id}', [WholesaleCustomersController::class, 'destroy'])->name('wholesale-customer.destroy');

//Manajemen Teknisi
Route::get('/dashboard/teknisi/create', [TeknisiController::class, 'create'])->name('teknisi.create');
Route::post('/dashboard/teknisi', [TeknisiController::class, 'store'])->name('teknisi.store');
Route::get('/dashboard/teknisi', [TeknisiController::class, 'index'])->name('teknisi.index');
Route::get('/dashboard/teknisi/semua', [TeknisiController::class, 'semua'])->name('teknisi.semua');
Route::get('/dashboard/teknisi/{id}/edit', [TeknisiController::class, 'edit'])->name('teknisi.edit');
Route::put('/dashboard/teknisi/{id}', [TeknisiController::class, 'update'])->name('teknisi.update');
Route::delete('/dashboard/teknisi/{id}', [TeknisiController::class, 'destroy'])->name('teknisi.destroy');
Route::get('/dashboard/teknisi/{id}/pindah-cabang', [TeknisiController::class, 'pindahCabang'])->name('teknisi.pindahcabang');
Route::post('/dashboard/teknisi/{id}/pindah-cabang', [TeknisiController::class, 'prosesPindahCabang'])->name('teknisi.pindahcabang.proses');

//Manajemen Service
Route::get('/dashboard/services/create', [ServicesController::class, 'create'])->name('services.create');
Route::post('/dashboard/services/store', [ServicesController::class, 'store'])->name('services.store');

Route::middleware([\App\Http\Middleware\CheckLogin::class])->group(function () {
    Route::get('/dashboard/services', [ServicesController::class, 'index'])->name('services.index');
    Route::get('/dashboard/service/pengambilan/{id}', [ServicesController::class, 'pengambilan'])->name('service.pengambilan'); // Add name here
    Route::put('/dashboard/service/pengambilan/{id}', [ServicesController::class, 'updatePengambilan'])->name('service.updatePengambilan'); 
    Route::get('/dashboard/services/{id}/edit', [ServicesController::class, 'edit'])->name('services.edit');
    Route::put('/dashboard/services/{id}', [ServicesController::class, 'update'])->name('services.update');
    Route::delete('/dashboard/services/{id}', [ServicesController::class, 'destroy'])->name('services.destroy');
    Route::get('/dashboard/services/{id}/cancel', [ServicesController::class, 'cancelView'])->name('services.cancel.view');
    Route::post('/dashboard/services/{id}/cancel', [ServicesController::class, 'cancel'])->name('services.cancel');
});

//Manajemen Diskon
Route::get('/dashboard/discounts/create', [DiscountsController::class, 'create'])->middleware([\App\Http\Middleware\CheckLogin::class])->name('discounts.create');
Route::post('/dashboard/discounts/store', [DiscountsController::class, 'store'])->middleware([\App\Http\Middleware\CheckLogin::class])->name('discounts.store');
Route::get('/dashboard/discounts', [DiscountsController::class, 'index'])->middleware([\App\Http\Middleware\CheckLogin::class])->name('discounts.index');
Route::get('/dashboard/discounts/edit/{id}', [DiscountsController::class, 'edit'])->middleware([\App\Http\Middleware\CheckLogin::class])->name('discounts.edit');
Route::put('/dashboard/discounts/update/{id}', [DiscountsController::class, 'update'])->middleware([\App\Http\Middleware\CheckLogin::class])->name('discounts.update');
Route::delete('/dashboard/discounts/destroy/{id}', [DiscountsController::class, 'destroy'])->middleware([\App\Http\Middleware\CheckLogin::class])->name('discounts.destroy');
Route::get('/dashboard/discounts/toggle/{id}', [DiscountsController::class, 'toggle'])->middleware([\App\Http\Middleware\CheckLogin::class])->name('discounts.toggle');
Route::get('/dashboard/discounts/show/{id}', [DiscountsController::class, 'show'])->middleware([\App\Http\Middleware\CheckLogin::class])->name('discounts.show');
Route::get('/dashboard/discounts/form/{id?}', [DiscountsController::class, 'form'])->middleware([\App\Http\Middleware\CheckLogin::class])->name('discounts.form');
Route::post('/dashboard/discounts/save/{id?}', [DiscountsController::class, 'save'])->middleware([\App\Http\Middleware\CheckLogin::class])->name('discounts.save');
Route::get('/dashboard/discounts/applyProduct', [DiscountsController::class, 'applyProduct'])->middleware([\App\Http\Middleware\CheckLogin::class])->name('discounts.applyProduct');
Route::get('/dashboard/discounts/applyCategory', [DiscountsController::class, 'applyCategory'])->middleware([\App\Http\Middleware\CheckLogin::class])->name('discounts.applyCategory');

//Manajemen Aktivitas
//ujicoba github kedua
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/activity-logs', [ActivityLogController::class, 'index'])
        ->name('activity-logs.index');
    
    Route::delete('/activity-logs/{id}', [ActivityLogController::class, 'destroy'])
        ->name('activity-logs.destroy')
        ->middleware(['auth', 'admin.only']);
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware([\App\Http\Middleware\CheckLogin::class]);

// Kasir
Route::get('/dashboard/kas-awal', [KasController::class, 'kasAwal'])->name('bukakasir');
Route::post('/dashboard/store-kas-awal', [KasController::class, 'store'])->name('store.kas_awal');
Route::get('/dashboard/cash-register/{id}/edit', [KasController::class, 'edit'])->name('edit.cash_register');
Route::delete('/dashboard/cash-register/{id}', [KasController::class, 'destroy'])->name('delete.cash_register');
Route::put('/dashboard/cash-register/{id}', [KasController::class, 'update'])->name('update.cash_register');
Route::get('/dashboard/penambahan', [KasController::class, 'penambahan'])->name('penambahan');
Route::post('/dashboard/penambahan/store', [KasController::class, 'storePenambahan'])->name('penambahan.store');
Route::delete('/dashboard/penambahan/{id}', [KasController::class, 'destroyPenambahan'])->name('penambahan.destroy');
Route::get('/dashboard/penambahan/{id}/edit', [KasController::class, 'editPenambahan'])->name('penambahan.edit');
Route::put('/dashboard/penambahan/{id}', [KasController::class, 'updatePenambahan'])->name('penambahan.update');

// Add these routes before the final closing brace
Route::get('dashboard/penarikan', [KasController::class, 'penarikan'])->name('penarikan');
Route::post('dashboard/penarikan/store', [KasController::class, 'storePenarikan'])->name('penarikan.store');
Route::get('dashboard/penarikan/{id}/edit', [KasController::class, 'editPenarikan'])->name('penarikan.edit');
Route::put('dashboard/penarikan/{id}', [KasController::class, 'updatePenarikan'])->name('penarikan.update');
Route::delete('dashboard/penarikan/{id}', [KasController::class, 'destroyPenarikan'])->name('penarikan.destroy');

// Cash Register Dashboard
Route::get('/dashboard/cashier', [KasController::class, 'dashboard'])->name('kas.dashboard');

// Session
Route::get('/tampilkan-semua-session', [SessionController::class, 'index'])->name('tampilkan-semua-session');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/categories/delete/{id}', [CategoriesController::class, 'destroy'])->name('categories.delete');

// Temporary debug route
Route::get('/suppliers/debug-data', function () {
    $outletId = session('outlet_id');
    $suppliers = \App\Models\ModelSuppliers::where('outlet_id', $outletId)->get();
    return response()->json([
        'outlet_id' => $outletId,
        'suppliers_count' => $suppliers->count(),
        'suppliers' => $suppliers
    ]);
});

// Add this route for debugging
Route::get('/debug/transactions', function() {
    $transactions = DB::table('transactions')
        ->select('transaction_id', 'outlet_id', 'total_amount', 'status', 'created_at')
        ->get();
    
    return response()->json([
        'session_outlet_id' => session('outlet_id'),
        'transactions' => $transactions,
        'count' => $transactions->count()
    ]);
});

// Add debugging route
Route::get('/debug/session', function() {
    return response()->json([
        'session_all' => session()->all(),
        'outlet_id' => session('outlet_id')
    ]);
});

Route::get('/debug/transactions/raw', function() {
    return response()->json([
        'transactions' => \App\Models\ModelTransaction::all(),
        'count' => \App\Models\ModelTransaction::count()
    ]);
});

// Add this route for advanced debugging
Route::get('/debug/transactions/full', function() {
    $model = new \App\Models\ModelTransaction();
    $rawData = $model->debug();
    
    return response()->json([
        'model_class' => get_class($model),
        'table' => $model->getTable(),
        'primary_key' => $model->getKeyName(),
        'connection' => $model->getConnectionName(),
        'raw_data' => $rawData,
        'relationships' => [
            'user' => $model->user()->getRelated()->getTable(),
            'outlet' => $model->outlet()->getRelated()->getTable(),
            'wholesaleCustomer' => $model->wholesaleCustomer()->getRelated()->getTable(),
        ]
    ]);
});

// Products Outlet Routes
Route::prefix('admin/products-outlet')->group(function () {
    Route::get('/', [ProductOutletsController::class, 'index'])->name('products-outlet.index');
    Route::get('/create', [ProductOutletsController::class, 'create'])->name('products-outlet.create');
    Route::post('/', [ProductOutletsController::class, 'store'])->name('products-outlet.store');
    Route::get('/{id}/edit', [ProductOutletsController::class, 'edit'])->name('products-outlet.edit');
    Route::put('/{id}', [ProductOutletsController::class, 'update'])->name('products-outlet.update');
    Route::delete('/{id}', [ProductOutletsController::class, 'destroy'])->name('products-outlet.destroy');
    Route::get('/{id}/add-serial', [ProductOutletsController::class, 'addSerial'])->name('products-outlet.add-serial');
    Route::post('/{id}/add-serial', [ProductOutletsController::class, 'storeSerial'])->name('products-outlet.store-serial');
    Route::get('/{id}/add-stock', [ProductOutletsController::class, 'addStock'])->name('products-outlet.add-stock');
    Route::post('/{id}/add-stock', [ProductOutletsController::class, 'storeStock'])->name('products-outlet.store-stock');
});

// Routes untuk mengelola session kasir type
Route::post('/clear-kasir-type', function() {
    session()->forget('type');
    return response()->json(['success' => true]);
});

Route::post('/set-kasir-type', function(Request $request) {
    session(['type' => $request->type]);
    return response()->json(['success' => true]);
});

// Manajemen Transaksi
Route::prefix('/dashboard/transactions')->middleware(['web', 'auth'])->group(function () {
    Route::get('/group', [TransactionController::class, 'getOutletGroupTransactions'])
        ->name('transactions.group');
    Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/data', [TransactionController::class, 'getData'])->name('transactions.data');
    Route::get('/{id}', [TransactionController::class, 'show'])->name('transactions.show'); 
    Route::get('/{id}/print', [TransactionController::class, 'printReceipt'])->name('receipt.print');
    Route::post('/cancel-item/{id}', [TransactionController::class, 'cancelItem'])->name('transactions.cancel-item');
    Route::get('/group', [TransactionController::class, 'getOutletGroupTransactions'])
        ->name('transactions.group');
});

Route::get('/dashboard/sales-report', [TransactionController::class, 'salesReport'])
    ->name('sales.report')
    ->middleware(['auth']);
    
Route::get('/dashboard/sales-report/group', [TransactionController::class, 'groupSalesReport'])
    ->name('sales.report.group')
    ->middleware(['auth']);

// Add this route at the bottom of your routes file
Route::get('/debug/transactions/test', function() {
    $transactions = \App\Models\ModelTransaction::with(['user', 'wholesaleCustomer'])->get();
    
    return response()->json([
        'raw_count' => $transactions->count(),
        'raw_data' => $transactions->toArray(),
        'formatted' => $transactions->map(function($t) {
            return [
                'id' => $t->transaction_id,
                'date' => $t->created_at,
                'amount' => $t->total_amount,
                'customer' => optional($t->wholesaleCustomer)->customer_name,
                'operator' => optional($t->user)->username
            ];
        })
    ]);
});

// Add at bottom of file
Route::get('/debug/transactions/check', function() {
    $raw = \App\Models\ModelTransaction::count();
    $withRelations = \App\Models\ModelTransaction::with(['user', 'wholesaleCustomer'])->get();
    
    return response()->json([
        'raw_count' => $raw,
        'with_relations_count' => $withRelations->count(),
        'sample' => $withRelations->first(),
        'formatted_sample' => [
            'id' => $withRelations->first()->transaction_id ?? null,
            'date' => optional($withRelations->first()->created_at)->format('d/m/Y H:i'),
            'customer' => optional($withRelations->first()->wholesaleCustomer)->customer_name
        ]
    ]);
});

// Add debug route
Route::get('/debug/transactions/api-test', function() {
    $data = \App\Models\ModelTransaction::with(['user', 'wholesaleCustomer'])->get();
    
    return response()->json([
        'status' => 'success',
        'count' => $data->count(),
        'sql' => \App\Models\ModelTransaction::with(['user', 'wholesaleCustomer'])->toSql(),
        'sample_raw' => $data->first(),
        'sample_formatted' => $data->first() ? [
            'date' => $data->first()->created_at->format('d/m/Y H:i'),
            'amount' => number_format($data->first()->total_amount, 0, ',', '.'),
            'customer' => optional($data->first()->wholesaleCustomer)->customer_name,
            'operator' => optional($data->first()->user)->username
        ] : null
    ]);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/outlet/upgrade-membership', [OutletController::class, 'showUpgradeMembership'])
        ->name('outlet.upgrade-membership');
    Route::post('/dashboard/outlet/request-upgrade', [OutletController::class, 'requestUpgrade'])
        ->name('outlet.request-upgrade');
    Route::post('/dashboard/outlet/request-downgrade', [OutletController::class, 'requestDowngrade'])
        ->name('outlet.request-downgrade');
    Route::get('/dashboard/outlet/change-membership', [OutletController::class, 'showUpgradeMembership'])
        ->name('outlet.change-membership');
    Route::get('/payment-confirmation/{requestId}', [PaymentConfirmationController::class, 'show'])
        ->name('payment.show');
    Route::post('/payment-confirmation/{requestId}', [PaymentConfirmationController::class, 'confirm'])
        ->name('payment.confirm');
    Route::get('/dashboard/outlet/profile/edit', [OutletController::class, 'editProfile'])
        ->name('outlet.profile.edit');
    Route::put('/dashboard/outlet/profile/update', [OutletController::class, 'updateProfile'])
        ->name('outlet.profile.update');
    Route::get('/dashboard/outlet/billing/info-outlet', [OutletController::class, 'showOutletInfo'])
        ->name('outlet.billing.info');
    Route::get('/dashboard/outlet/outlet/payment-history/{id?}', [OutletController::class, 'paymentHistory'])
        ->name('outlet.payment.history');
    Route::get('/dashboard/outlet/billing', [OutletController::class, 'showBilling'])
        ->name('outlet.billing');
    Route::post('/dashboard/outlet/enable-auto-renewal', [OutletController::class, 'enableAutoRenewal'])
        ->name('outlet.enable-auto-renewal');
    Route::post('/dashboard/outlet/cancel-auto-renewal', [OutletController::class, 'cancelAutoRenewal'])
        ->name('outlet.cancel-auto-renewal');
        
});

Route::prefix('owner')->middleware(['auth'])->group(function () {
    // Add this new route for owner dashboard
    Route::get('/dashboard', [DashboardController::class, 'ownerDashboard'])
        ->name('owner.dashboard');
        
    // ...existing owner routes...
    Route::get('/membership/upgrade-requests', [MembershipController::class, 'upgradeRequests'])
        ->name('membership.upgrade-requests');
    Route::get('/membership/approve-request/{outletId}', [MembershipController::class, 'approveRequest'])
        ->name('membership.approve-request');
    Route::get('/membership/reject-request/{outletId}', [MembershipController::class, 'rejectRequest'])
        ->name('membership.reject-request');
    Route::get('/membership/delete-request/{outletId}', [MembershipController::class, 'deleteRequest'])
        ->name('membership.delete-request');
    
    // Add this new route for outlet management
    Route::get('/outlet', [OutletController::class, 'index'])->name('owner.outlets.index');
    Route::get('/outlet/{id}/branches', [OutletController::class, 'showBranches'])->name('owner.outlets.branches');
    Route::get('/outlet/{id}/membership-history', [OutletController::class, 'membershipHistory'])
        ->name('owner.outlets.membership-history');
    Route::get('/outlet/{id}/detail', [OutletController::class, 'detail'])->name('owner.outlets.detail');
});

// Update any route that references the view directly
Route::get('/membership/changes', function() {
    return view('membership.change-requests');
})->name('membership.changes');

// ...existing code...

// Membership Change Request Routes
Route::get('/owner/membership/change-requests', [MembershipChangeRequestController::class, 'index'])
    ->name('owner.membership.change-requests');
Route::post('/owner/membership/approve-request/{id}', [MembershipChangeRequestController::class, 'approveRequest'])
    ->name('owner.membership.approve-request');
Route::post('/owner/membership/reject-request/{id}', [MembershipChangeRequestController::class, 'rejectRequest'])
    ->name('owner.membership.reject-request');
Route::post('/owner/membership/verify-payment/{id}', [MembershipChangeRequestController::class, 'verifyPayment'])
    ->name('owner.membership.verify-payment');
Route::post('/owner/membership/process-request/{id}', [MembershipChangeRequestController::class, 'processRequest'])
    ->name('owner.membership.process-request');
Route::delete('/owner/membership/delete-request/{id}', [MembershipChangeRequestController::class, 'deleteRequest'])
    ->name('owner.membership.delete-request');

// Settings Routes
// Route::prefix('settings')->name('settings.')->middleware(['auth'])->group(function() {
//     Route::get('/theme', [SettingsController::class, 'theme'])->name('theme');
//     Route::get('/privacy', [SettingsController::class, 'privacy'])->name('privacy');
//     Route::get('/dashboard-customization', [SettingsController::class, 'dashboardCustomization'])->name('dashboard-customization');
//     Route::get('/access-control', [SettingsController::class, 'accessControl'])->name('access-control'); 
//     Route::get('/security', [SettingsController::class, 'security'])->name('security');
// });

// ...existing code...

Route::get('/dashboard/saran/create', [SaranController::class, 'create'])->name('saran.create');
// Route::post('/dashboard/saran', [SaranController::class, 'store'])->name('saran.store'); //hapus rute ini karena sudah kita ganti

// ...existing code...

// Route::get('/membership/details', [MembershipController::class, 'details'])->name('membership.details'); // hapus rute ini
Route::get('/membership/details', [FrontController::class, 'membershipDetails'])->name('membership.details');

// ...existing code...




// ...existing code...




// ...existing code...

// Kas Awal Routes
Route::get('/dashboard/kas-awal', [KasController::class, 'kasAwal'])->name('kas-awal');
Route::post('/dashboard/kas-awal/store', [KasController::class, 'store'])->name('store.kas_awal');
Route::get('/dashboard/kas-awal/{id}/edit', [KasController::class, 'editKasAwal'])->name('edit.kas_awal');
Route::put('/dashboard/kas-awal/{id}', [KasController::class, 'updateKasAwal'])->name('update.kas_awal');
Route::delete('/dashboard/kas-awal/{id}', [KasController::class, 'destroyKasAwal'])->name('delete.kas_awal');

// ...existing code...

// Penambahan Kas Routes
Route::get('dashboard/penambahan', [KasController::class, 'penambahan'])->name('penambahan');
Route::post('dashboard/penambahan/store', [KasController::class, 'storePenambahan'])->name('penambahan.store');
Route::get('dashboard/penambahan/{id}/edit', [KasController::class, 'editPenambahan'])->name('penambahan.edit');
Route::put('dashboard/penambahan/{id}', [KasController::class, 'updatePenambahan'])->name('penambahan.update');
Route::delete('dashboard/penambahan/{id}', [KasController::class, 'destroyPenambahan'])->name('penambahan.destroy');

// ...existing code...

// Kas Akhir Routes
Route::get('/dashboard/kas-akhir', [KasController::class, 'kasAkhir'])->name('kas-akhir');
Route::post('/dashboard/kas-akhir/store', [KasController::class, 'storeKasAkhir'])->name('store.kas_akhir');
Route::get('/dashboard/kas-akhir/{id}/edit', [KasController::class, 'editKasAkhir'])->name('edit.kas_akhir');
Route::put('/dashboard/kas-akhir/{id}', [KasController::class, 'updateKasAkhir'])->name('update.kas_akhir');
Route::delete('/dashboard/kas-akhir/{id}', [KasController::class, 'destroyKasAkhir'])->name('delete.kas_akhir');

// ...existing code...

// Kas Adjustment Routes
Route::get('/dashboard/kas/adjustments', [KasController::class, 'showAdjustments'])->name('kas.adjustments');
Route::post('/dashboard/kas/adjustments', [KasController::class, 'storeAdjustment'])->name('kas.adjustments.store');

// ...existing code...

// ...existing code...

Route::get('/dashboard/kas/tutup', [KasController::class, 'tutupKas'])->name('kas.tutup');
Route::post('/dashboard/kas/tutup', [KasController::class, 'storeTutupKas'])->name('kas.tutup.store');

// ...existing code...

// Add this route in your web.php file
Route::get('/dashboard/kas/akurasi', [KasController::class, 'showAkurasi'])->name('kas.akurasi');

// ...existing code...