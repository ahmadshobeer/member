<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        View::composer('*', function ($view) {


            $viewName = $view->getName();

            // Daftar view yang dikecualikan
            $excludedViews = [
                'auth.login', // Nama view form login
                // Tambahkan view lain di sini jika perlu
            ];

            if (!in_array($viewName, $excludedViews)) {
                $user = Auth::user(); // Data pengguna yang sedang login
                // $pelanggan = $user->pelanggan; // Ambil data pelanggan yang terkait

                $view->with('user', $user);
                // $view->with('pelanggan', $pelanggan);
                
            }
            
            
        });
    }
}
