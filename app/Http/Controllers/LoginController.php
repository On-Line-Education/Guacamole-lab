<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    //

    public function login(LoginRequest $request): JsonResponse
    {
        // system login
        $user = User::query();
        $user = $user
            ->where("username", "=", $request->get("username"))
            ->first();
        if (is_null($user) || !Hash::check($request->get("password"), $user->password)) {
            abort(Response::HTTP_UNAUTHORIZED, "Invalid credentials");
        }
        $token = $user->createToken(Carbon::now() . $request->device_name);

        // guacamole login ??

        return response()->json([
            'token' => $token->plainTextToken,
            'tokenId' => $token->accessToken->id,
            'user' => $user
        ]);
    }

    public function logout(): JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json(true);
    }

    public function logoutAll(): JsonResponse
    {
        Auth::user()->tokens()->delete();
        return response()->json(true);
    }
}
