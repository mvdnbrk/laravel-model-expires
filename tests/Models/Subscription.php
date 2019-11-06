<?php

namespace Mvdnbrk\ModelExpires\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Mvdnbrk\ModelExpires\Expires;

class Subscription extends Model
{
    use Expires;

    protected $guarded = [];

    protected $table = 'subscriptions';
}
