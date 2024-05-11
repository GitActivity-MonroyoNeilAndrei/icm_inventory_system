<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;
use App\Helpers\Barcode;
use App\Models\Transaction;
use App\Http\Middleware\TrustHosts;
use Illuminate\Auth\Notifications\ResetPassword;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('login', [AuthController::class, 'login']);
    
Route::post('login', [AuthController::class, 'authenticate'])->name('login');

Route::get('login', [AuthController::class, 'login'])->middleware('guest');

Route::get('/forget-password', [ForgotPasswordController::class, 'forgetPassword'])->name('forget.password');
Route::post('/forget-password', [ForgotPasswordController::class, 'forgetPasswordPost'])->name('forget.password.post');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');

Route::post('/reset-password/{token}', [ForgotPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');


Route::get('check', function () {
    return auth()->user();
});

Route::get('user/change-password/{id}', [UserController::class, 'changePassword'])->name('changePassword');
Route::post('user/update-password/{id}', [UserController::class, 'updatePassword'])->name('updatePassword');



Route::get('item/import', [App\Http\Controllers\ItemController::class, 'index']);
Route::post('item/import', [App\Http\Controllers\ItemController::class, 'importExcelData']);

Route::get('barcode/{id}', [ItemController::class, 'generateBarcode'])->name('barcode.generate');

 
Route::prefix('admin')->middleware(['admin', 'auth'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('item/Unavailable', [ItemController::class, 'indexUnavailable'])->name('admin.item.indexUnavailable');

    Route::resource('item', ItemController::class)->names([
        'index' => 'admin.item.index',
        'store' => 'admin.item.store',
        'edit' => 'admin.item.edit',
        'update' => 'admin.item.update'
    ]);

    Route::resource('user', UserController::class);

    Route::resource('employee', EmployeeController::class);

    Route::post('user/change-status/{id}', [UserController::class, 'isActivated'])->name('user.changeStatus');

    Route::post('employee/change-status/{id}', [EmployeeController::class, 'isActivated'])->name('employee.changeStatus');
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('option', OptionController::class);

    Route::post('settings/{id}', [UserController::class, 'updateProfile'])->name('admin.settings.update-profile');

    Route::post('settings/update-password/{id}', [UserController::class, 'updateProfilePassword'])->name('admin.updateProfilePassword');

    Route::resource('transaction', TransactionController::class);

    Route::get('transaction/add/{id}', [TransactionController::class, 'add'])->name('transaction.add');

    Route::post('transaction/storeTxn/{id}', [TransactionController::class, 'storeTxn'])->name('transaction.store.txn');

    Route::resource('report', ReportController::class);

    Route::get('scan', function() {
       return view('admin.items.scan-item');
    })->name('item.scan');

    Route::get('exportTransaction', [TransactionController::class, 'exportCSV'])->name('transaction.exportCSV');

    Route::get('exportReport', [ReportController::class, 'exportCSV'])->name('report.exportCSV');

});


Route::prefix('op')->middleware(['op', 'auth'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('op.dashboard');

    Route::get('item/Unavailable', [ItemController::class, 'indexUnavailable'])->name('op.item.indexUnavailable');

    Route::resource('item', ItemController::class)->names([
        'index' => 'op.item.index',
        'store' => 'op.item.store',
        'edit' => 'op.item.edit',
        'update' => 'op.item.update'
    ]);

    Route::resource('transaction', TransactionController::class)->names([
        'index' => 'op.transaction.index',
        'store' => 'op.transaction.store',
        'edit' => 'op.transaction.edit',
        'update' => 'op.transaction.update'
    ]);

    Route::resource('report', ReportController::class)->names([
        'index' => 'op.report.index',
        'store' => 'op.report.store',
        'edit' => 'op.report.edit',
        'update' => 'op.report.update'
    ]);

    Route::get('transaction/add/{id}', [TransactionController::class, 'add'])->name('op.transaction.add');

    Route::post('transaction/storeTxn/{id}', [TransactionController::class, 'storeTxn'])->name('op.transaction.store.txn');

    Route::get('exportTransaction', [TransactionController::class, 'exportCSV'])->name('transaction.exportCSV');

    Route::get('exportReport', [ReportController::class, 'exportCSV'])->name('report.exportCSV');

    Route::post('logout', [AuthController::class, 'logout'])->name('op.logout');
});
