<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Log;

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

    public function scopeSearch(Builder $query, $search): Builder
    {
        Log::info($search);
        $query->when(
            $search['price'] ?? null,
            fn (Builder $query, $price) => $query->whereRelation(
                'prices',
                'active',
                '=',
                true
            )->where(fn ($q) => $q->whereRelation(
                'prices',
                'usd',
                '<=',
                $price / AppSetting::query()->first()->usd_rate
            )->orWhereRelation('prices', 'mmk', '<=', $price))
        );

        $query->when(
            $search['carat'] ?? null,
            fn (Builder $query, $carat) => $query->whereRelation(
                'specification',
                'carat_weight',
                '<=',
                $carat
            )
        );

        $query->when(
            $search['color'] ?? null,
            fn (Builder $query, $color) => $query->whereRelation(
                'specification',
                'color_grade',
                '>=',
                $color
            )
        );

        $query->when(
            $search['clarity'] ?? null,
            fn (Builder $query, $clarity) => $query->whereRelation(
                'specification',
                'clarity_grade',
                '>=',
                $clarity
            )
        );

        $query->when(
            $search['cut'] ?? null,
            fn (Builder $query, $cut) => $query->whereRelation(
                'specification',
                'cut_grade',
                '>=',
                $cut
            )
        );

        return $query;
    }

    public function specification(): HasOne
    {
        return $this->hasOne(Specification::class);
    }

    public function pictures(): MorphMany
    {
        return $this->morphMany(Picture::class, 'pictureable')->latest('sort');
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function activePrices(): HasMany
    {
        return $this->hasMany(Price::class)->where('active', true);
    }
}
