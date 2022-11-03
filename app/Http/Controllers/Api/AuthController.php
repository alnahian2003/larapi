<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create($validated);

        $token = $user->createToken($user->name)->plainTextToken;


        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);

        // Check Email
        $user = User::where("email", $validated['email'])->first();

        // Check for password
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response(['message' => "Credentials doesn't match our record"], 401);
        }

        // Create token
        $token = $user->createToken($user->name)->plainTextToken;


        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }


    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response(['message' => 'Logged out successfully']);
    }
}
