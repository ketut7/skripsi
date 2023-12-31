<?php

namespace App\Providers;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view)
        {
            $jumlahKeranjang = Auth::user() ? Keranjang::where('user_id', Auth::user()->id)->sum('jumlah') : 0;

            $view->with('cart_count', $jumlahKeranjang );
        });

//        dd(Auth::user());
//        View::share(
//            'cart_count',
//            12
//        );
    }
}
