<?php

namespace Mvdnbrk\ModelExpires\Tests\Database;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mvdnbrk\ModelExpires\Tests\TestCase;

class MigrationTest extends TestCase
{
    /** @test */
    public function it_can_add_the_expires_at_column()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->expires();
        });

        $this->assertEquals('datetime', Schema::getColumnType('subscriptions', 'expires_at'));
    }

    /** @test */
    public function it_can_add_the_expires_at_column_with_a_custom_name()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->expires('finishes_at');
        });

        $this->assertEquals([
            'finishes_at',
        ], Schema::getColumnListing('subscriptions'));
    }

    /** @test */
    public function it_can_drop_the_expires_at_column()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->expires();
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropExpires();
        });

        $this->assertEquals([
            'id',
        ], Schema::getColumnListing('subscriptions'));
    }
}
