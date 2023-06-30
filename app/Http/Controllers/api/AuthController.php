<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    const TOKEN_TIME = 60;

    public function login(LoginRequest $request)
    {
        if (!$token = auth()->attempt($request->all())) {
            abort(401, 'Unauthorized');
        }

        return $this->generateTokenResponse($token);
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->createUser($request->all());

        $token = $this->generateToken($user);

        return $this->generateTokenResponse($token);
    }

    private function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    private function generateToken(User $user)
    {
        return JWTAuth::fromUser($user);
    }

    private function generateTokenResponse(string $token)
    {
        return response()->json([
            'data' => [
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * self::TOKEN_TIME
            ]
        ]);
    }
}
