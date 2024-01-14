<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends BaseModel
{
    protected static function booted(): void
    {
        static::created(function (Price $price) {
            $price->refresh();
            if ($price->active)
                Price::query()->where('id', '!=', $price->id)
                    ->where('item_id', $price->item_id)
                    ->update(['active' => false]);
            if (Price::query()->where('item_id', $price->item_id)->count() > 5) {
                Price::query()
                    ->where('item_id', $price->item_id)
                    ->orderBy('id', 'asc')->first()->delete();
            }
        });
    }
    use HasFactory, Filterable;

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
