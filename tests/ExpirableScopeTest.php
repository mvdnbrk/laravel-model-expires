<?php

namespace Mvdnbrk\ModelExpires\Tests;

use Illuminate\Support\Carbon;
use Mvdnbrk\ModelExpires\Tests\Models\Subscription;

class ExpirableScopeTest extends TestCase
{
    /* @var \Mvdnbrk\ModelExpires\Tests\Models\Subscription */
    protected $expired;

    /* @var \Mvdnbrk\ModelExpires\Tests\Models\Subscription */
    protected $expiresInFuture;

    /* @var \Mvdnbrk\ModelExpires\Tests\Models\Subscription */
    protected $expiresNever;

    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow('2019-01-01 12:34:56');

        $this->expired = Subscription::create([
            'expires_at' => Carbon::now()->addDay(),
        ]);

        Carbon::setTestNow();

        $this->expiresNever = Subscription::create([
            'expires_at' => null,
        ]);

        $this->expiresInFuture = Subscription::create([
            'expires_at' => Carbon::now()->addDay(),
        ]);
    }

    /** @test */
    public function it_can_retrieve_only_expired_models()
    {
        tap(Subscription::onlyExpired()->get(), function ($models) {
            $this->assertCount(1, $models);
            $this->assertTrue($models->first()->is($this->expired));
        });
    }

    /** @test */
    public function it_can_retrieve_all_models_without_expired()
    {
        tap(Subscription::withoutExpired()->get(), function ($models) {
            $this->assertCount(2, $models);
            $this->assertTrue($models->contains($this->expiresNever));
            $this->assertTrue($models->contains($this->expiresInFuture));
        });
    }
}
