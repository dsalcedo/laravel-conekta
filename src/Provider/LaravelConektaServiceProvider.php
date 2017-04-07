<?php
namespace LaravelConekta;

use Illuminate\Support\ServiceProvider;

class LaravelConektaServiceProvider extends ServiceProvider {

    public function boot() {
        // Allow your user to publish the config
        $this->publishes([
            __DIR__.'/../config/conekta.php' => config_path('conekta.php'),
        ], 'config');

    }

    public function register() {
        // Load the config file and merge it with the user's (should it get published)
        $this->mergeConfigFrom( __DIR__.'/../config/conekta.php', 'conekta');
    }

}