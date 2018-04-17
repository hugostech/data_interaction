<?php

namespace Hugostech\Data_interaction;


use Illuminate\Support\ServiceProvider;

class DataInteractionServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/DataInteraction.php' =>config_path('DataInteraction.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('DI',function($app){
            return new DataInteractionService();
        });
    }

    public function provides()
    {
        return ['DI'];
    }
}
