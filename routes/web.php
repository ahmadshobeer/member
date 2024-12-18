<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


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
    
    Route::post('/change-avatar', [ProfileController::class, 'updateAvatar'])->name('avatar.update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // Tambahkan route lainnya di sini

});

Route::get('/', function () {
    return Auth::check() ? redirect('/dashboard') : redirect('/auth/login');
});

Route::middleware(['guest'])->group(function () {
    Route::get('auth/login', [AuthController::class, 'index'])->name('login');
    Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');


    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
   /*  Route::post('/reset-password', function (Request $request) {
        
    })->middleware('guest')->name('password.update'); */
    
    /* Route::post('/forgot-password', function (Request $request) {
       
    })->name('password.no_hp'); */

    // Route::get('reset-password', [AuthController::class, 'resetForm'])->name('reset.password ');
});

