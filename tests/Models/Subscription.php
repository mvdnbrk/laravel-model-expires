<?php

namespace Mvdnbrk\ModelExpires\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Mvdnbrk\ModelExpires\Expirable;

class Subscription extends Model
{
    use Expirable;

    protected $guarded = [];

    protected $table = 'subscriptions';

    public $timestamps = false;
}
