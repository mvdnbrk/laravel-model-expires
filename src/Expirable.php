<?php

namespace Mvdnbrk\ModelExpires;

use DateTimeInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\InteractsWithTime;

/**
 * @property array $attributes
 * @property array $dates
 */
trait Expirable
{
    use InteractsWithTime;

    /**
     * Boot the expirable trait for a model.
     *
     * @return void
     */
    public static function bootExpirable()
    {
        static::addGlobalScope(new ExpiringScope);
    }

    /**
     * Initialize the expirable trait for an instance.
     *
     * @return void
     */
    public function initializeExpirable()
    {
        $this->dates[] = $this->getExpiresAtColumn();
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
     * Determine if the model instance has expired.
     *
     * @return bool
     */
    public function expired()
    {
        $expiresAt = $this->{$this->getExpiresAtColumn()};

        return $expiresAt && $expiresAt->isPast();
    }

    /**
     * Determine if the model instance will expire.
     *
     * @return bool
     */
    public function willExpire()
    {
        $expiresAt = $this->{$this->getExpiresAtColumn()};

        return $expiresAt && $expiresAt->isFuture();
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
     * Get the fully qualified "expires at" column.
     *
     * @return string
     */
    public function getQualifiedExpiresAtColumn()
    {
        return $this->qualifyColumn($this->getExpiresAtColumn());
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
}
