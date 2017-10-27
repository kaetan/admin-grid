<?php

namespace Estaticzz\AdminGrid;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'admin-grid');

        $this->publishes([
            __DIR__.'/../views' => base_path('resources/views/vendor/admin-grid'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
