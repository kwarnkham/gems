<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Models\Specification;
use Illuminate\Http\Request;

class SpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'item_id' => ['required', 'exists:items,id'],
            'carat' => ['sometimes', 'required'],
            'cut' => ['sometimes', 'required'],
            'clarity' => ['sometimes', 'required'],
            'color' => ['sometimes', 'required'],
            'certification' => ['sometimes', 'required'],
            'shape' => ['sometimes', 'required'],
            'origin' => ['sometimes', 'required']
        ]);

        $specification = Specification::query()->create($data);

        return response()->json($specification, HttpStatus::CREATED->value);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specification $specification)
    {
        $data = $request->validate([
            'carat' => ['sometimes'],
            'cut' => ['sometimes'],
            'clarity' => ['sometimes'],
            'color' => ['sometimes'],
            'certification' => ['sometimes'],
            'shape' => ['sometimes'],
            'origin' => ['sometimes']
        ]);

        $specification->update($data);

        return response()->json($specification, HttpStatus::OK->value);
    }


    public function find(Specification $specification)
    {
        return response()->json($specification);
    }
}
