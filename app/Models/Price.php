<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends BaseModel
{
    protected static function booted(): void
    {
        static::created(function (Price $price) {
            if ($price->active)
                Price::query()->where('id', '!=', $price->id)->update(['active' => false]);
        });
    }
    use HasFactory, Filterable;
}
