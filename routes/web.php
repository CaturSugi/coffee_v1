<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\POS\TransactionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Manager\DashboardController as ManagerDashboard;
use App\Http\Controllers\Manager\PromotionController;
use App\Http\Controllers\Manager\ReportController as ManagerReportController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes - Public Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Web Routes - Public Website
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');

// Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |----------------------------------------------------------------------
    | POS System Routes
    |----------------------------------------------------------------------
    */
    Route::prefix('pos')->name('pos.')->middleware('role:cs,admin,manager')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('/products', [TransactionController::class, 'getProducts'])->name('products');
        Route::get('/products/{id}', [TransactionController::class, 'getProduct'])->name('product.show');
        Route::post('/members/search', [TransactionController::class, 'searchMembers'])->name('members.search');
        Route::post('/promotions/validate', [TransactionController::class, 'validatePromotion'])->name('promotions.validate');

        Route::post('/transactions', [TransactionController::class, 'store'])->name('transaction.store');
        Route::get('/transactions', [TransactionController::class, 'list'])->name('transaction.list');
        Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transaction.show');
        Route::put('/transactions/{id}/payment', [TransactionController::class, 'processPayment'])->name('transaction.payment');
        Route::post('/transactions/{id}/mark-as-paid', [TransactionController::class, 'markAsPaid'])->name('transaction.mark-as-paid');
        Route::post('/transactions/{id}/cancel', [TransactionController::class, 'cancel'])->name('transaction.cancel');
        Route::post('/transactions/{id}/serve', [TransactionController::class, 'markAsServed'])->name('transaction.serve');
        Route::get('/notifications/unserved', [TransactionController::class, 'getUnservedOrders'])->name('notifications.unserved');

        // Print Routes
        Route::post('/transactions/{id}/print-thermal', [TransactionController::class, 'printThermal'])->name('print.thermal');
        Route::post('/transactions/{id}/print-bluetooth', [TransactionController::class, 'printBluetooth'])->name('print.bluetooth');
        Route::get('/transactions/{id}/download-pdf', [TransactionController::class, 'downloadPDF'])->name('print.pdf');
    });

    /*
    |----------------------------------------------------------------------
    | Admin Routes
    |----------------------------------------------------------------------
    */
    /*
    |----------------------------------------------------------------------
    | Shared Management Routes (Admin & Manager)
    |----------------------------------------------------------------------
    */
    Route::middleware('role:admin,manager')->group(function () {
        // Product Management
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('products', ProductController::class);
            Route::post('products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');
            
            // Member Management
            Route::resource('members', MemberController::class);
            Route::post('members/{id}/restore', [MemberController::class, 'restore'])->name('members.restore');
        });
    });

    /*
    |----------------------------------------------------------------------
    | Admin-Only Routes
    |----------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::get('/dashboard/chart-data', [AdminDashboard::class, 'chartData'])->name('dashboard.chart-data');

        // User Management (Admin Only)
        Route::resource('users', UserController::class);

        // Reports
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('dashboard', [ReportController::class, 'dashboard'])->name('dashboard');
            Route::get('sales', [ReportController::class, 'sales'])->name('sales');
            Route::get('products', [ReportController::class, 'products'])->name('products');
            Route::get('members', [ReportController::class, 'members'])->name('members');
            Route::get('export', [ReportController::class, 'export'])->name('export');
        });

        // Settings
        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
    });

    /*
    |----------------------------------------------------------------------
    | Manager Routes
    |----------------------------------------------------------------------
    */
    Route::prefix('manager')->name('manager.')->middleware('role:manager,admin')->group(function () {
        Route::get('/', [ManagerDashboard::class, 'index'])->name('dashboard');
        Route::get('/dashboard/chart-data', [ManagerDashboard::class, 'chartData'])->name('dashboard.chart-data');

        // Promotion Management
        Route::resource('promotions', PromotionController::class);

        // Reports
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('sales', [ManagerReportController::class, 'sales'])->name('sales');
            Route::get('products', [ManagerReportController::class, 'products'])->name('products');
            Route::get('members', [ManagerReportController::class, 'members'])->name('members');
        });
    });

    /*
    |----------------------------------------------------------------------
    | CS Routes
    |----------------------------------------------------------------------
    |*/
    Route::prefix('cs')->name('cs.')->middleware('role:cs,admin,manager')->group(function () {
        Route::get('/', [App\Http\Controllers\CS\DashboardController::class, 'index'])->name('dashboard');
        
        // Member Management for CS
        Route::resource('members', App\Http\Controllers\CS\MemberController::class);
        
        // Product Catalog for CS (Read-only)
        Route::get('products', [App\Http\Controllers\CS\ProductController::class, 'index'])->name('products.index');
        Route::get('products/{product}', [App\Http\Controllers\CS\ProductController::class, 'show'])->name('products.show');

        // Reports for CS
        Route::get('reports/sales', [App\Http\Controllers\CS\ReportController::class, 'sales'])->name('reports.sales');
    });

    /*
    |----------------------------------------------------------------------
    | Kitchen / Barista Routes (KDS)
    |----------------------------------------------------------------------
    |*/
    Route::prefix('kitchen')->name('kitchen.')->middleware('role:cs,admin,manager')->group(function () {
        Route::get('/', [App\Http\Controllers\Kitchen\KitchenController::class, 'index'])->name('dashboard');
        Route::post('/{transaction}/status', [App\Http\Controllers\Kitchen\KitchenController::class, 'updateStatus'])->name('update-status');
    });

    /*
    |----------------------------------------------------------------------
    | User Profile Routes
    |----------------------------------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [AuthController::class, 'showProfile'])->name('index');
        Route::post('/', [AuthController::class, 'updateProfile'])->name('update');
        Route::post('/password', [AuthController::class, 'updatePassword'])->name('password');

        // Member specific routes
        Route::get('/transactions', [AuthController::class, 'myTransactions'])->name('transactions');
        Route::get('/points', [AuthController::class, 'myPoints'])->name('points');
    });

    /*
    |----------------------------------------------------------------------
    | Member Routes
    |----------------------------------------------------------------------
    */
    Route::prefix('member')->name('member.')->group(function () {
        Route::get('/', [AuthController::class, 'memberDashboard'])->name('dashboard');
        Route::post('register', [AuthController::class, 'registerMember'])->name('register');
        Route::get('/my-profile', [AuthController::class, 'memberProfile'])->name('profile');
    });
});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::prefix('api')->name('api.')->group(function () {

    // Public API
    Route::get('/products', [TransactionController::class, 'getProducts']);
    Route::get('/products/{id}', [TransactionController::class, 'getProduct']);

    // Protected API (requires authentication)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/transactions', [TransactionController::class, 'store']);
        Route::get('/transactions', [TransactionController::class, 'list']);
        Route::get('/transactions/{id}', [TransactionController::class, 'show']);
        Route::post('/transactions/{id}/payment', [TransactionController::class, 'processPayment']);

        // Promotion API
        Route::post('/promotions/validate', [TransactionController::class, 'validatePromotion']);

        // Member API
        Route::post('/members/search', [TransactionController::class, 'searchMembers']);
    });
});
