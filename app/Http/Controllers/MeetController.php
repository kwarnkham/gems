<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Models\Meet;
use Illuminate\Http\Request;

class MeetController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'contact_id' => ['required', 'exists:contacts,id'],
            'note' => ['required'],

        ]);
        $meet = Meet::query()->create($data);
        return response()->json($meet, HttpStatus::CREATED->value);
    }
}
