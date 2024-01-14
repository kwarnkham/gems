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
                    ->whereRelation('item', 'items.id', '=', $price->item_id)
                    ->update(['active' => false]);
        });
    }
    use HasFactory, Filterable;

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
