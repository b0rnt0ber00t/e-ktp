<?php

use App\Http\Controllers\Admin\EktpRegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('app');
});

Route::middleware('guest')->group(function() {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'store'])->name('login.store');

    Route::get('register', [AuthController::class, 'create'])->name('register');
    Route::post('register', [AuthController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('user')->group(function() {
        Route::get('', [UserController::class, 'index' ])->name('user');
        Route::put('{status}' , [UserController::class        , 'update'])->name('user.update');
        Route::get('register' , [EktpRegisterController::class, 'create'])->name('user.register');
        Route::get('show/{id}', [UserController::class        , 'show'  ])->name('user.show');
        Route::put('edit/{id}', [UserController::class        , 'edit'  ])->name('user.edit');
    });

    Route::get('logout', [AuthController::class, 'destroy'])->name('logout');
});
