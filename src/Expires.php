<?php

namespace Mvdnbrk\ModelExpires;

use Illuminate\Support\Carbon;

trait Expires
{
    /**
     * Initialize the expires trait for an instance.
     *
     * @return void
     */
    public function initializeExpires()
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
}
