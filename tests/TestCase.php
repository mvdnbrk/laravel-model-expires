<?php

namespace Mvdnbrk\ModelExpires\Tests;

use Mvdnbrk\ModelExpires\ModelExpiresServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        //
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ModelExpiresServiceProvider::class,
        ];
    }
}
