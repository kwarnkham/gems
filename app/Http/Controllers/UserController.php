<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function find(Request $request, User $user)
    {
        return response()->json($user);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
