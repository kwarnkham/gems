<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        $query = Item::query()->with(['pictures', 'active_prices'])->latest('id')->filter($filters);

        return response()->json(['data' => $query->paginate($request->per_page ?? 10)], HttpStatus::OK->value);
    }

    public function find(Request $request, Item $item)
    {
        return response()->json($item->fresh(['specification', 'pictures', 'prices']), HttpStatus::OK->value);
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


    public function addPictures(Request $request, Item $item)
    {
        $data = $request->validate([
            'pictures' => ['required', 'array'],
            'pictures.*' => ['required', 'image']
        ]);

        foreach ($data['pictures'] as $picture) {
            $name = Storage::putFile('items', $picture);
            $item->pictures()->create(['name' => $name]);
        }

        return response()->json($item->fresh(['pictures']), HttpStatus::CREATED->value);
    }
}
