<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Models\Student; // Your student model
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    /**
     * Handle student login and return a token.
     */
    public function login(Request $request)
    {
        $student = Student::where('email', $request->email)->first();

        if (!$student || !Hash::check($request->password, $student->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Generate a Sanctum token
        $token = $student->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'student' => $student,
        ]);
    }

    /**
     * Handle student logout and revoke the token.
     */
    public function logout(Request $request)
    {
        // Revoke the current token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }
}
