<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends BaseModel
{
    use HasFactory;

    public function meets()
    {
        return $this->hasMany(Meet::class)->latest('id');
    }

    public function preOrders()
    {
        return $this->hasMany(PreOrder::class)->latest('id');
    }
}
