<?php

namespace Mvdnbrk\EloquentExpirable;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class ExpirableServiceProvider extends ServiceProvider
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
        $this->registerBlueprintMacros();
    }

    /**
     * Register the blueprint macros.
     *
     * @return void
     */
    protected function registerBlueprintMacros()
    {
        if ($this->app->runningInConsole()) {
            Blueprint::macro('expires', function ($column = 'expires_at', $precision = 0) {
                /* @var \Illuminate\Database\Schema\Blueprint $this */
                $this->timestamp($column, $precision)->nullable();
            });

            Blueprint::macro('dropExpires', function ($column = 'expires_at') {
                /* @var \Illuminate\Database\Schema\Blueprint $this */
                $this->dropColumn($column);
            });
        }
    }
}
