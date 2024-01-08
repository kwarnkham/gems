<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'usd' => ['required', 'numeric'],
            'mmk' => ['required', 'numeric'],
            'item_id' => ['required', 'exists:items,id']
        ]);

        $price = Price::query()->create($data);

        return response()->json($price, HttpStatus::CREATED->value);
    }

    public function update(Request $request, Price $price)
    {
        $data = $request->validate([
            'usd' => ['required', 'numeric'],
            'mmk' => ['required', 'numeric'],
            'active' => ['required', 'boolean']
        ]);

        $price->update($data);

        return response()->json($price, HttpStatus::OK->value);
    }
}
