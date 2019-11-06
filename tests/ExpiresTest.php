<?php

namespace Mvdnbrk\ModelExpires\Tests;

use Illuminate\Support\Facades\Date;
use Mvdnbrk\ModelExpires\Tests\Models\CustomSubscription;
use Mvdnbrk\ModelExpires\Tests\Models\Subscription;

class ExpiresTest extends TestCase
{
    /** @test */
    public function it_has_a_expires_at_column_with_value_null()
    {
        $model = Subscription::create();

        $this->assertNull($model->fresh()->expires_at);
    }

    /** @test */
    public function it_adds_the_expires_at_column_to_date_casts()
    {
        $model = Subscription::make();

        $this->assertContains('expires_at', $model->getDates());
    }

    /** @test */
    public function it_can_determine_the_expires_at_column()
    {
        $model = Subscription::make();

        $this->assertEquals('expires_at', $model->getExpiresAtColumn());
    }

    /** @test */
    public function it_can_customize_the_expires_at_column()
    {
        $model = CustomSubscription::make();

        $this->assertEquals('finishes_at', $model->getExpiresAtColumn());
    }

    /** @test */
    public function it_can_determine_if_it_has_expired()
    {
        $model = Subscription::make([
            'expires_at' => null,
        ]);
        $this->assertFalse($model->expired());

        $model->expires_at = Date::now()->addMinute();
        $this->assertFalse($model->expired());

        $model->expires_at = Date::now()->subMinute();
        $this->assertTrue($model->expired());
    }
}
