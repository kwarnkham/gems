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

    public function index(Request $request)
    {
        return response()->json([
            'data' => Contact::query()->paginate($request->per_page ?: 10)
        ]);
    }

    public function find(Request $request, Contact $contact)
    {
        return response()->json($contact->load(['meets']));
    }
}
