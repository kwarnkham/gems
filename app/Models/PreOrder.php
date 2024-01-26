<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PreOrder extends BaseModel
{
    use HasFactory, Filterable;


    protected $with = ['contact'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
