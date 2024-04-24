<?php
/**
 * Copyright (c) 2018.
 * @author Bruno Michalski, Antony Chacha
 */

namespace RandomWhiteTrash\Grid\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use RandomWhiteTrash\Grid\Commands\GenerateGrid;
use RandomWhiteTrash\Grid\ModalRenderer;

class GridServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadHelpers();

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'randomwhitetrash');

        $this->loadPackageConfig();

        $this->loadPackageAssets();

        $this->registerCustomEvents();
    }

    /**
     * Load helper function files
     *
     * @return void
     */
    protected function loadHelpers(): void
    {
        $files = glob(__DIR__ . '/../Helpers/*.php');
        foreach ($files as $file) {
            require_once($file);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(GenerateGrid::class);
        $this->registerServices();
    }

    /**
     * Register app services
     *
     * @return void
     */
    public function registerServices()
    {
        $this->app->singleton('modal', function ($app) {
            return new ModalRenderer();
        });
    }

    /**
     * Register custom events
     *
     * @return void
     */
    public function registerCustomEvents(): void
    {
        // events
        Event::listen('grid.fetch_data', 'RandomWhiteTrash\\Grid\\Listeners\\HandleUserAction@handle');
        Event::listen('grid.column_processed', 'RandomWhiteTrash\\Grid\\Listeners\\AddExtraAttributesToProcessedColumn@handle');
        Event::listen('grid.initialized', 'RandomWhiteTrash\\Grid\\Listeners\\GridWasInitialized@handle');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['modal'];
    }

    /**
     * Load package assets
     *
     * @return void
     */
    public function loadPackageAssets(): void
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/randomwhitetrash')
        ], 'views');

        // only publish compiled assets
        $this->publishes([
            __DIR__ . '/../resources/assets/dist' => base_path('public/vendor/randomwhitetrash/grid')
        ], 'assets');
    }

    /**
     * Load package config
     *
     * @return void
     */
    public function loadPackageConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../resources/config/grid.php' => config_path('grid.php')
        ], 'config');
    }
}
