<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //require_once app_path('Helpers/GlobalHelper.php');
        foreach (glob(app_path() . '/Helpers/*.php') as $file) {
            require_once($file);
        }        
    }
}
