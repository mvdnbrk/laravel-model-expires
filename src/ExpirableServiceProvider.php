<?php

namespace Mvdnbrk\EloquentExpirable;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class ExpirableServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerBlueprintMacros();
    }

    /**
     * Register the blueprint macros.
     *
     * @return void
     */
    protected function registerBlueprintMacros(): void
    {
        if ($this->app->runningInConsole()) {
            Blueprint::macro('expires', function ($column = 'expires_at', $precision = 0) {
                /* @var \Illuminate\Database\Schema\Blueprint $this */
                return $this->timestamp($column, $precision)->nullable();
            });

            Blueprint::macro('dropExpires', function ($column = 'expires_at') {
                /* @var \Illuminate\Database\Schema\Blueprint $this */
                return $this->dropColumn($column);
            });
        }
    }
}
