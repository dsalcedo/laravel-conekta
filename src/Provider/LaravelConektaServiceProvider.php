<?php
namespace LaravelConekta;

use Illuminate\Support\ServiceProvider;

class LaravelConektaServiceProvider extends ServiceProvider {

    public function boot() {
        $this->publishes([__DIR__.'/../config/conekta.php' => config_path('conekta.php')], 'config');
    }

    public function register() {
        $this->mergeConfigFrom( __DIR__.'/../config/conekta.php', 'conekta');
    }
}