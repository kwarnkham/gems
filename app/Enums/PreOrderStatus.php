<?php

namespace App\Enums;

enum PreOrderStatus: int
{
    case PENDING = 1;
    case PAID = 2;
    case COMPLETED = 3;
    case REFUNDED = 4;
    case CANCELED = 5;

    public static function all()
    {
        return [1, 2, 3, 4, 5];
    }
}
