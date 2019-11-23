<?php

namespace Mvdnbrk\EloquentExpirable\Tests\Database;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ColumnDefinition;
use Illuminate\Support\Facades\Schema;
use Mvdnbrk\EloquentExpirable\Tests\TestCase;

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
    public function it_is_chainable()
    {
        $table = new Blueprint('subscriptions');

        $this->assertInstanceOf(ColumnDefinition::class, $table->expires());
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
