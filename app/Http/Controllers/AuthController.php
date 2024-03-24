<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users', // Ensure unique email
                'password' => 'required|min:8|confirmed', // Enforce password confirmation
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator); // Throw ValidationException for proper error handling
            }

            $user = User::create($request->all());

            return $this->success('Registered successfully', 201, [
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return $this->internalServerError('Failed to create user',500,$e->getMessage());
        }
    }

    public function login(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',  // Validate email format
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return $this->success('Login successful', 200, [
                'user' => $user,
                'token' => $token,
            ]);
        }

        return $this->error('Invalid login credentials', 401);

    } catch (\Exception $e) {
        // Avoid exposing sensitive error details in production
        // Log the exception for debugging
        return $this->internalServerError('Failed to authenticate',500, $e->getMessage());
    }
}


    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return $this->success('Logged out successfully', 200);
        } catch (\Exception $e) {
            return $this->internalServerError('Failed to logout', $e->getMessage());
        }
    }

    public function forgotPassword()
    {
        // Implement logic for password reset functionality
        // ... (consider using Laravel's built-in password reset functionality)
    }
}
