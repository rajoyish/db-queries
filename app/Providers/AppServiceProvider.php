<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // This shows SQL query, binding and time on the homepage
        DB::listen(function ($query) {
            var_dump($query->sql);

            var_dump($query->binding ?? 'no binding');

            var_dump($query->time);
        });
    }
}
