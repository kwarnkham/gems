<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:categories']
        ]);

        $category = Category::query()->create($data);

        return response()->json($category, HttpStatus::CREATED->value);
    }

    public function index()
    {
        return response()->json(Category::all());
    }
}
