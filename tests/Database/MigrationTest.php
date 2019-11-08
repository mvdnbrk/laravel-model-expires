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
}
