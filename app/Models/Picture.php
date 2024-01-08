<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Picture extends BaseModel
{
    use HasFactory;

    public function pictureable(): MorphTo
    {
        return $this->morphTo();
    }
}
