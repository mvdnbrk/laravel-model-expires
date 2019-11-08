<?php

namespace Mvdnbrk\ModelExpires\Tests\Database;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mvdnbrk\ModelExpires\Tests\TestCase;

class MigrationTest extends TestCase
{
    /** @test */
    public function it_runs_the_migrations()
    {
        $this->assertEquals([
            'id',
            'expires_at',
            'created_at',
            'updated_at',
        ], Schema::getColumnListing('subscriptions'));
    }

    /** @test */
    public function it_has_the_correct_column_type()
    {
        $this->assertEquals('datetime', Schema::getColumnType('subscriptions', 'expires_at'));
    }

    /** @test */
    public function it_can_drop_the_expires_at_column()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropExpires();
        });

        $this->assertEquals([
            'id',
            'created_at',
            'updated_at',
        ], Schema::getColumnListing('subscriptions'));
    }
}
