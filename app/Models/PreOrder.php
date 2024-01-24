<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PreOrder extends BaseModel
{
    use HasFactory;

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
