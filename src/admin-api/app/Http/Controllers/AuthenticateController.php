<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Models\Action;

class AuthenticateController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only(['params']);
        $credentials = $credentials['params'];
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $requestUser = $request->user();
        $user = User::with('roles.actions')->find($requestUser->id);

        return response()->json(compact('token', 'user'));
    }
}