<?php

namespace Mvdnbrk\EloquentExpirable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ExpiringScope implements Scope
{
    /** @var array */
    protected $extensions = [
        'Expiring',
        'NotExpiring',
        'OnlyExpired',
        'WithoutExpired',
    ];

    public function apply(Builder $builder, Model $model): void
    {
        //
    }

    public function extend(Builder $builder): void
    {
        foreach ($this->extensions as $extension) {
            $this->{"add{$extension}"}($builder);
        }
    }

    protected function addExpiring(Builder $builder): void
    {
        $builder->macro('expiring', function (Builder $builder) {
            $model = $builder->getModel();

            return $builder->whereNotNull($model->getQualifiedExpiresAtColumn())
                ->where($model->getQualifiedExpiresAtColumn(), '>', $model->freshTimestamp());
        });
    }

    protected function addNotExpiring(Builder $builder): void
    {
        $builder->macro('notExpiring', function (Builder $builder) {
            return $builder->whereNull($builder->getModel()->getQualifiedExpiresAtColumn());
        });
    }

    protected function addOnlyExpired(Builder $builder): void
    {
        $builder->macro('onlyExpired', function (Builder $builder) {
            $model = $builder->getModel();

            return $builder->where($model->getQualifiedExpiresAtColumn(), '<=', $model->freshTimestamp());
        });
    }

    protected function addWithoutExpired(Builder $builder): void
    {
        $builder->macro('withoutExpired', function (Builder $builder) {
            $model = $builder->getModel();

            return $builder->where($model->getQualifiedExpiresAtColumn(), '>', $model->freshTimestamp())
                ->orWhereNull($model->getQualifiedExpiresAtColumn());
        });
    }
}
