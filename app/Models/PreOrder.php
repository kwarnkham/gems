<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PreOrder extends BaseModel
{
    use HasFactory;


    protected $with = ['contact'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
