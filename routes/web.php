<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


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


Route::resource('admin/user', UserController::class);


Route::post('user/change-status/{id}', [UserController::class, 'isActivated'])->name('user.changeStatus');

Route::resource('admin/item', ItemController::class);


Route::get('admin/login', [AuthController::class, 'login']);

Route::post('admin/login', [AuthController::class, 'authenticate'])->name('login');

Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin/dashboard');

