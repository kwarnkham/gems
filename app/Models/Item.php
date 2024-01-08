<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Item extends BaseModel
{
    use HasFactory, Filterable;

    public function scopeHasSpecification(Builder $query): Builder
    {
        // Item::hasSpecification()->hasPictures()->hasPrices()->get()
        return $query->has('specification');
    }

    public function scopeHasPictures(Builder $query): Builder
    {
        return $query->has('pictures');
    }

    public function scopeHasPrices(Builder $query): Builder
    {
        return $query->has('price');
    }

    public function specification(): HasOne
    {
        return $this->hasOne(Specification::class);
    }

    public function pictures(): MorphMany
    {
        return $this->morphMany(Picture::class, 'pictureable');
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }
}
