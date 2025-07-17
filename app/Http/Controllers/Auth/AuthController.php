<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'mobile' => 'required|unique:users,mobile',
            'address' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $response = AuthService::register($data);
        return response()->success($response);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'mobile' => 'required',
            'password' => 'required',
        ]);
        return response()->success(AuthService::login($credentials));
    }
}
