<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Carbon\Traits\Date;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    //

    function login(LoginRequest $request): JsonResponse
    {
        // system login
        $user = User::query();
        $user = $user
            ->where("username", "=", $request->get("username"))
            ->first();
        if (!Hash::check($request->get("password"), $user->password)){
            abort(Response::HTTP_UNAUTHORIZED);
        }
        $token = $user->createToken(Date::now().$request->device_name);

        // guacamole login ??

        return response()->json([
            'token' => $token->plainTextToken,
            'tokenId' => $token->id,
            'user' => $user
        ]);
    }

    function logout(int $tokenId): JsonResponse
    {
        Auth::user()->tokens()->where('id', $tokenId)->delete();
        return response()->json(true);
    }

    function logoutAll(): JsonResponse
    {
        Auth::user()->tokens()->delete();
        return response()->json(true);
    }
}
