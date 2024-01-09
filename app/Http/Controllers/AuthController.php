<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::query()->where('name', $data['name'])->first();
        abort_if($user == null || !Hash::check($data['password'], $user->password), HttpStatus::UNAUTHORIZED->value, "Login failed");

        $user->tokens()->delete();
        $token = $user->createToken("");

        return response()->json(['user' => $user, 'token' => $token->plainTextToken]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json();
    }
}
