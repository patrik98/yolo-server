<?php

namespace App\Http\Controllers;

use App\Helpers\JsonValidator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $data = JsonValidator::validate($request->getContent(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            "token" => $user->createToken($request->getClientIp() ?? 'no-ip')->plainTextToken
        ]);
    }

    public function logout()
    {
        try {
            Auth::user()->tokens()->delete();
            return response("user logged out", 204);
        } catch (\Exception $e) {
            return response("could not logout", 400);
        }
    }
}
