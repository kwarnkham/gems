<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Item extends BaseModel
{
    use HasFactory, Filterable;

    public function scopeHasSpecification(Builder $query): Builder
    {
        return $query->has('specification');
    }

    public function scopeHasPicture(Builder $query): Builder
    {
        return $query->has('pictures');
    }

    public function specification(): HasOne
    {
        return $this->hasOne(Specification::class);
    }

    public function pictures(): MorphMany
    {
        return $this->morphMany(Picture::class, 'pictureable');
    }
}
