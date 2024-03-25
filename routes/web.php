<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OptionController;


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
    return view('welcome');
});


Route::get('login', [AuthController::class, 'login']);
    
Route::post('login', [AuthController::class, 'authenticate'])->name('login');

Route::get('check', function () {
    return auth()->user();
});

 
Route::prefix('admin')->middleware(['admin', 'auth'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::resource('item', ItemController::class)->names([
        'index' => 'admin.item.index',
        'store' => 'admin.item.store',
        'edit' => 'admin.item.edit',
        'update' => 'admin.item.update'
    ]);

    Route::resource('user', UserController::class);

    Route::post('user/change-status/{id}', [UserController::class, 'isActivated'])->name('user.changeStatus');
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('option', OptionController::class);

});




Route::prefix('user')->middleware(['user', 'auth'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('user.dashboard');


    Route::resource('item', ItemController::class)->names([
        'index' => 'user.item.index',
        'store' => 'user.item.store',
        'edit' => 'user.item.edit',
        'update' => 'user.item.update'
    ]);


    Route::post('logout', [AuthController::class, 'logout'])->name('user.logout');


});



