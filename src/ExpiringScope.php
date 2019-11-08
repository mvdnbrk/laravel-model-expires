<?php

namespace Mvdnbrk\ModelExpires;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ExpiringScope implements Scope
{
    /**
     * All of the extensions to be added to the builder.
     *
     * @var array
     */
    protected $extensions = [
        'Expiring',
        'NotExpiring',
        'OnlyExpired',
        'WithoutExpired',
    ];

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        //
    }

    /**
     * Extend the query builder with the needed functions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    public function extend(Builder $builder)
    {
        foreach ($this->extensions as $extension) {
            $this->{"add{$extension}"}($builder);
        }
    }

    /**
     * Add the "expiring" extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    protected function addExpiring(Builder $builder)
    {
        $builder->macro('expiring', function (Builder $builder) {
            $model = $builder->getModel();

            return $builder->whereNotNull($model->getQualifiedExpiresAtColumn())
                ->where($model->getQualifiedExpiresAtColumn(), '>', $model->freshTimestamp());
        });
    }

    /**
     * Add the "notExpiring" extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    protected function addNotExpiring(Builder $builder)
    {
        $builder->macro('notExpiring', function (Builder $builder) {
            return $builder->whereNull($builder->getModel()->getQualifiedExpiresAtColumn());
        });
    }

    /**
     * Add the "onlyExpired" extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    protected function addOnlyExpired(Builder $builder)
    {
        $builder->macro('onlyExpired', function (Builder $builder) {
            $model = $builder->getModel();

            return $builder->where($model->getQualifiedExpiresAtColumn(), '<=', $model->freshTimestamp());
        });
    }

    /**
     * Add the "withoutExpired" extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    protected function addWithoutExpired(Builder $builder)
    {
        $builder->macro('withoutExpired', function (Builder $builder) {
            $model = $builder->getModel();

            return $builder->where($model->getQualifiedExpiresAtColumn(), '>', $model->freshTimestamp())
                ->orWhereNull($model->getQualifiedExpiresAtColumn());
        });
    }
}
