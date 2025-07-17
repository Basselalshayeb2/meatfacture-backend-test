<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{

    /**
     * @param array $data
     * @return array
     */
    static public function register(array $data): array
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $accessToken = $user->createToken('authToken')->accessToken;
        return [
            'user' => $user,
            'accessToken' => $accessToken,
        ];
    }

    static public function login(array $credentials): array
    {
        $user = User::where('mobile', $credentials['mobile'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'mobile' => ['Invalid credentials'],
            ]);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
