<?php

namespace Mvdnbrk\ModelExpires;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\InteractsWithTime;

/**
 * @method \Illuminate\Support\Carbon freshTimestamp()
 * @property array $attributes
 * @property array $dates
 */
trait Expirable
{
    use InteractsWithTime;

    /**
     * Initialize the expires trait for an instance.
     *
     * @return void
     */
    public function initializeExpirable()
    {
        $this->dates[] = $this->getExpiresAtColumn();
    }

    /**
     * Determine if the model instance has expired.
     *
     * @return bool
     */
    public function expired()
    {
        if ($expires = $this->{$this->getExpiresAtColumn()}) {
            return Carbon::parse($expires)->isPast();
        }

        return false;
    }

    /**
     * Get the name of the "expires at" column.
     *
     * @return string
     */
    public function getExpiresAtColumn()
    {
        return defined('static::EXPIRES_AT') ? static::EXPIRES_AT : 'expires_at';
    }

    /**
     * Set the "expires at" column for an instance.
     *
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     * @return void
     */
    public function setExpiresAtAttribute($ttl)
    {
        $seconds = $this->getSeconds($ttl);

        $this->attributes[$this->getExpiresAtColumn()] = $seconds ? Carbon::now()->addSeconds($seconds) : null;
    }

    /**
     * Calculate the number of seconds for the given TTL.
     *
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     * @return int
     */
    protected function getSeconds($ttl)
    {
        $duration = $ttl ? $this->parseDateInterval($ttl) : 0;

        if ($duration instanceof DateTimeInterface) {
            $duration = Carbon::now()->diffInRealSeconds($duration, false);
        }

        return (int) $duration > 0 ? $duration : 0;
    }

    /**
     * Scope a query to only include expired models.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnlyExpired(Builder $query)
    {
        return $query->where($this->getExpiresAtColumn(), '<=', $this->freshTimestamp());
    }

    /**
     * Scope a query to only include expired models.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutExpired(Builder $query)
    {
        return $query->where($this->getExpiresAtColumn(), '>', $this->freshTimestamp())
            ->orWhereNull($this->getExpiresAtColumn());
    }
}
