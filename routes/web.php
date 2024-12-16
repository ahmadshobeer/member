<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;


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

/* Route::get('/', function () {
    return view('dashboard');
}); */
/* 
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post'); */
// Dashboard route with middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/my-account', [ProfileController::class, 'index'])->name('my-account');
    Route::post('/password/change', [AuthController::class, 'updatePassword'])->name('password.update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // Tambahkan route lainnya di sini

});

Route::get('/', function () {
    return Auth::check() ? redirect('/dashboard') : redirect('/auth/login');
});

Route::get('auth/login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::post('/change-avatar', [ProfileController::class, 'updateAvatar'])->name('avatar.update');