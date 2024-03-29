<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $query, $filters): Builder
    {
        $query->when(
            $filters['status'] ?? null,
            fn (Builder $query, $status) => $query->whereIn(
                'status',
                explode(',', $status)
            )
        );

        $query->when(
            $filters['name'] ?? null,
            fn (Builder $query, $name) => $query->where(
                'name',
                'like',
                "%{$name}%"
            )
        );

        $query->when(
            $filters['item_id'] ?? null,
            fn (Builder $query, $itemId) => $query->where(
                'item_id',
                $itemId
            )
        );

        $query->when(
            $filters['contact_id'] ?? null,
            fn (Builder $query, $contactId) => $query->where(
                'contact_id',
                $contactId
            )
        );



        return $query;
    }
}
