<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'phone' => ['required'],
            'message' => ['sometimes']
        ]);

        $contact = Contact::query()->create($data);

        return response()->json($contact, HttpStatus::CREATED->value);
    }
}
