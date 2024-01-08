<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:items'],
            'description' => ['required'],
        ]);

        $item = Item::query()->create($data);

        return response()->json($item, HttpStatus::CREATED->value);
    }

    public function index(Request $request)
    {
        $filters = $request->validate([
            'name' => ['sometimes']
        ]);

        $query = Item::query()->latest('id')->filter($filters);

        return response()->json($query->paginate($request->per_page ?? 10), HttpStatus::OK->value);
    }

    public function find(Request $request, Item $item)
    {
        return response()->json($item, HttpStatus::OK->value);
    }

    public function update(Request $request, Item $item)
    {
        $data = $request->validate([
            'name' => ['required', Rule::unique('items')->ignoreModel($item)],
            'description' => ['required'],
        ]);

        $item = Item::query()->update($data);

        return response()->json($item, HttpStatus::OK->value);
    }
}
