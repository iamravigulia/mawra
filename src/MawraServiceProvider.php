<?php

namespace edgewizz\mawra;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class MawraServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Edgewizz\Mawra\Controllers\MawraController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // dd($this);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__ . '/components', 'mawra');
        Blade::component('mawra::mawra.open', 'mawra.open');
        Blade::component('mawra::mawra.index', 'mawra.index');
        Blade::component('mawra::mawra.edit', 'mawra.edit');
    }
}
