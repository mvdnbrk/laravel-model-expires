<?php

namespace Mvdnbrk\ModelExpires\Tests\Database;

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
        ], Schema::getColumnListing('subscriptions'));
    }

    /** @test */
    public function it_has_the_correct_column_type()
    {
        $this->assertEquals('datetime', Schema::getColumnType('subscriptions', 'expires_at'));
    }
}
