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
     * Display the specified resource.
     */
    public function show(Specification $specification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specification $specification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specification $specification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specification $specification)
    {
        //
    }
}
