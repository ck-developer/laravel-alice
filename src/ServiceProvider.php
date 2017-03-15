<?php

namespace Ck\Laravel\Alice;

use Ck\Laravel\Alice\Persister\EloquentPersister;
use Ck\Laravel\Alice\Loader\Loader;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerPersister();
        $this->registerLoader();
        $this->registerCommand();
    }

    private function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/alice.php','alice');
    }

    private function registerPersister()
    {
        $this->app->singleton('alice.eloquent_persister', function($app) {
            return new EloquentPersister($app->make('db.connection'));
        });
    }

    private function registerLoader()
    {
        $this->app->singleton('alice.loader', function($app) {

            $config = $app->make('config');

            return new Loader(
                $app->make('alice.eloquent_persister'),
                $config->get('alice.locale'),
                $config->get('alice.providers'),
                $config->get('alice.seed'),
                $config->all()
            );
        });
    }

    private function registerCommand()
    {
        $this->app->singleton('alice.command', function ($app) {
            return $app->make('Ck\Laravel\Alice\Command\SeedCommand');
        });
        
        $this->commands('alice.command');
    }

}
