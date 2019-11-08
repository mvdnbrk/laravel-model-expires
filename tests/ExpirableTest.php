<?php

namespace Mvdnbrk\ModelExpires\Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Mvdnbrk\ModelExpires\Expirable;

class ExpirableTest extends TestCase
{
    /** @test */
    public function it_has_a_expires_at_column_with_value_null()
    {
        $model = ModelStub::make();

        $this->assertNull($model->expires_at);
    }

    /** @test */
    public function it_adds_the_expires_at_column_to_date_casts()
    {
        $model = ModelStub::make();

        $this->assertContains('expires_at', $model->getDates());
    }

    /** @test */
    public function it_can_determine_the_expires_at_column()
    {
        $model = ModelStub::make();

        $this->assertEquals('expires_at', $model->getExpiresAtColumn());
    }

    /** @test */
    public function it_can_customize_the_expires_at_column()
    {
        $model = CustomModelStub::make();

        $this->assertEquals('ends_at', $model->getExpiresAtColumn());
    }

    /** @test */
    public function it_can_determine_qualified_expires_at_column_column()
    {
        $model = ModelStub::make();

        $this->assertEquals('model_table.expires_at', $model->getQualifiedExpiresAtColumn());

        $model = CustomModelStub::make();

        $this->assertEquals('model_table.ends_at', $model->getQualifiedExpiresAtColumn());
    }

    /** @test */
    public function it_can_set_the_expires_at_column()
    {
        Carbon::setTestNow('2019-11-11 11:11:11');

        $model = ModelStub::make([
            'expires_at' => Carbon::now()->addYear(),
         ]);

        $this->assertTrue($model->expires_at->equalTo('2020-11-11 11:11:11'));
    }

    /** @test */
    public function it_can_set_the_expires_at_column_with_an_integer()
    {
        Carbon::setTestNow('2019-11-11 11:11:11');

        $model = ModelStub::make([
            'expires_at' => 60,
         ]);

        $this->assertTrue($model->expires_at->equalTo('2019-11-11 11:12:11'));
    }

    /** @test */
    public function it_unsets_the_expires_at_column_with_a_date_in_the_past()
    {
        $model = ModelStub::make([
            'expires_at' => Carbon::now()->subMinute(),
         ]);

        $this->assertNull($model->expires_at);
    }

    /** @test */
    public function it_can_determine_if_it_has_expired()
    {
        $model = ModelStub::make([
            'expires_at' => null,
        ]);
        $this->assertFalse($model->expired());

        $model->expires_at = Carbon::now()->addMinute();
        $this->assertFalse($model->expired());

        Carbon::setTestNow(Carbon::now()->addDay());
        $this->assertTrue($model->expired());
    }

    /** @test */
    public function it_can_determine_if_it_will_expire()
    {
        $model = ModelStub::make([
            'expires_at' => null,
        ]);
        $this->assertFalse($model->willExpire());

        $model->expires_at = Carbon::now()->addMinute();
        $this->assertTrue($model->willExpire());

        Carbon::setTestNow(Carbon::now()->addDay());
        $this->assertFalse($model->willExpire());
    }
}

class ModelStub extends Model
{
    use Expirable;

    protected $table = 'model_table';

    protected $guarded = [];
}

class CustomModelStub extends ModelStub
{
    const EXPIRES_AT = 'ends_at';
}
