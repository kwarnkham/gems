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
            'shape' => ['sometimes', 'required'],
            'measurements' => ['sometimes', 'required'],
            'carat_weight' => ['sometimes', 'required', 'numeric'],
            'color_grade' => ['sometimes', 'required', 'numeric'],
            'clarity_grade' => ['sometimes', 'required', 'numeric'],
            'cut_grade' => ['sometimes', 'required', 'numeric'],
            'polish' => ['sometimes', 'required'],
            'symmetry' => ['sometimes', 'required'],
            'fluorescence' => ['sometimes', 'required'],
            'clarity_characteristics' => ['sometimes', 'required'],
            'certification' => ['sometimes', 'required'],
            'origin' => ['sometimes', 'required'],
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
            'shape' => ['sometimes', 'required'],
            'measurements' => ['sometimes', 'required'],
            'carat_weight' => ['sometimes', 'required', 'numeric'],
            'color_grade' => ['sometimes', 'required', 'numeric'],
            'clarity_grade' => ['sometimes', 'required', 'numeric'],
            'cut_grade' => ['sometimes', 'required', 'numeric'],
            'polish' => ['sometimes', 'required'],
            'symmetry' => ['sometimes', 'required'],
            'fluorescence' => ['sometimes', 'required'],
            'clarity_characteristics' => ['sometimes', 'required'],
            'certification' => ['sometimes', 'required'],
            'origin' => ['sometimes', 'required'],
        ]);

        $specification->update($data);

        return response()->json($specification, HttpStatus::OK->value);
    }


    public function find(Specification $specification)
    {
        return response()->json($specification);
    }
}
