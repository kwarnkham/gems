<?php

namespace App\Enums;

enum ColorGrade: int
{
    case D = 1;
    case E = 2;
    case F = 3;
    case G = 4;
    case H = 5;
    case I = 6;
    case J = 7;
    case K = 8;
    case L = 9;
    case M = 10;
    case N = 11;
    case OP = 12;
    case QR = 13;
    case ST = 14;
    case UV = 15;
    case WX = 16;
    case YZ = 17;

    public static function colorless()
    {
        return [1, 2, 3];
    }

    public static function nearColorless()
    {
        return [4, 5, 6, 7];
    }

    public static function faint()
    {
        return [8, 9, 10];
    }

    public static function veryLight()
    {
        return [11, 12, 13];
    }

    public static function light()
    {
        return [14, 15, 16, 17];
    }
}
