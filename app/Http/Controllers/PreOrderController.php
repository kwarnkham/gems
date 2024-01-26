<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Models\Contact;
use App\Models\PreOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = PreOrder::query();
        return response()->json(['data' => $query->paginate($request->per_page ?? 10)]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'phone' => ['required'],
            'category' => ['required'],
            'price' => ['required', 'numeric'],
            'shape' => ['required'],
            'color' => ['required'],
            'carat' => ['required', 'numeric'],
            'cut' => ['required'],
            'clarity' => ['required']
        ]);

        $preOrder = DB::transaction(function () use ($data) {
            $contact = Contact::query()->where('phone', $data['phone'])->first();
            if ($contact == null) $contact = Contact::query()->create(['name' => $data['name'], 'phone' => $data['phone']]);
            else $contact->update(['phone' => $data['phone']]);

            $preOrder = $contact->preOrders()->create(
                [
                    'category' => $data['category'],
                    'price' => $data['price'],
                    'shape' => $data['shape'],
                    'color' => $data['color'],
                    'carat' => $data['carat'],
                    'cut' => $data['cut'],
                    'clarity' => $data['clarity']
                ]
            );

            return $preOrder;
        });

        return response()->json($preOrder, HttpStatus::CREATED->value);
    }

    public function update(Request $request, PreOrder $preOrder)
    {
        $data = $request->validate([
            'category' => ['required'],
            'price' => ['required', 'numeric'],
            'shape' => ['required'],
            'color' => ['required'],
            'carat' => ['required', 'numeric'],
            'cut' => ['required'],
            'clarity' => ['required'],
            'certificate' => ['sometimes'],
            'expected_arrival_date' => ['sometimes', 'date'],
            'deposit' => ['sometimes', 'numeric'],
            'mounted' => ['sometimes', 'boolean'],
            'mount_spec' => ['sometimes', 'json'],
        ]);

        $preOrder->update($data);

        return response()->json($preOrder);
    }

    public function find(Request $request, PreOrder $preOrder)
    {
        return response()->json($preOrder);
    }
}
