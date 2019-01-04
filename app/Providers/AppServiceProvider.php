<?php

namespace App\Providers;

use App\Reservation;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);


        //broj zavrsenih rezervacija
        view()->composer('layouts.admin', function ($view) {

            date_default_timezone_set('Europe/Sarajevo');


            $rezs = Reservation::where('zavrsena','0')->get();

            $danas = Carbon::now()->format('d-m-Y');
            foreach($rezs as $rez)
            {
                if(Carbon::parse($rez->datum_do)->format('d-m-Y') <= $danas)
                {
                    $rez->zavrsena = '1';
                    $rez->save();
                }
            }
            $brojZavrsenih = Reservation::where('zavrsena','1')->where('naplacena','0')->count();
            $view->with('brojZavrsenih', $brojZavrsenih);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
