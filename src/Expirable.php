<?php

namespace Mvdnbrk\EloquentExpirable;

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

    public static function bootExpirable(): void
    {
        static::addGlobalScope(new ExpiringScope);
    }

    public function initializeExpirable(): void
    {
        $this->dates[] = $this->getExpiresAtColumn();
    }

    /**
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     */
    public function setExpiresAtAttribute($ttl): void
    {
        $seconds = $this->getSeconds($ttl);

        $this->attributes[$this->getExpiresAtColumn()] = $seconds ? Carbon::now()->addSeconds($seconds) : null;
    }

    public function discardExpiration(): self
    {
        $this->setExpiresAtAttribute(0);

        return $this;
    }

    public function expired(): bool
    {
        $expiresAt = $this->{$this->getExpiresAtColumn()};

        return $expiresAt && $expiresAt->isPast();
    }

    public function willExpire(): bool
    {
        $expiresAt = $this->{$this->getExpiresAtColumn()};

        return $expiresAt && $expiresAt->isFuture();
    }

    public function getExpiresAtColumn(): string
    {
        return defined('static::EXPIRES_AT') ? static::EXPIRES_AT : 'expires_at';
    }

    public function getQualifiedExpiresAtColumn(): string
    {
        return $this->qualifyColumn($this->getExpiresAtColumn());
    }

    /**
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     */
    protected function getSeconds($ttl): int
    {
        $duration = $ttl ? $this->parseDateInterval($ttl) : 0;

        if ($duration instanceof DateTimeInterface) {
            $duration = Carbon::now()->diffInRealSeconds($duration, false);
        }

        return (int) $duration > 0 ? $duration : 0;
    }
}
