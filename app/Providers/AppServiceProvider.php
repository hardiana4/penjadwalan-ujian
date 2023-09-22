<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Models\Sesi;

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
        // Validator::extend('unique_time_range', function ($attribute, $value, $parameters, $validator) {
        //     [$startTime, $endTime] = explode(' - ', $value);

        //     $count = Sesi::where(function ($query) use ($startTime, $endTime) {
        //         $query->where(function ($q) use ($startTime, $endTime) {
        //             $q->where('waktu_awal', '>=', $startTime)
        //             ->where('waktu_awal', '<', $endTime);
        //         })->orWhere(function ($q) use ($startTime, $endTime) {
        //             $q->where('waktu_akhir', '>', $startTime)
        //             ->where('waktu_akhir', '<=', $endTime);
        //         });
        //     })->count();

        //     return $count === 0; // Return true jika tidak ada tabrakan waktu
        // });
    }
}
