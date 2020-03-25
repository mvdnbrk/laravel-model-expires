<?php

namespace Mvdnbrk\EloquentExpirable;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class ExpirableServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerBlueprintMacros();
    }

    protected function registerBlueprintMacros(): void
    {
        if ($this->app->runningInConsole()) {
            Blueprint::macro('expires', function (string $column = 'expires_at', int $precision = 0) {
                /* @var \Illuminate\Database\Schema\Blueprint $this */
                return $this->timestamp($column, $precision)->nullable();
            });

            Blueprint::macro('dropExpires', function (string $column = 'expires_at') {
                /* @var \Illuminate\Database\Schema\Blueprint $this */
                return $this->dropColumn($column);
            });
        }
    }
}
