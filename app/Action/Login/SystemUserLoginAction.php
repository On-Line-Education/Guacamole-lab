<?php

namespace App\Action\Login;

use App\Exceptions\InvalidCredentialsException;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SystemUserLoginAction {


    /**
     * @param string $username
     * @param string $password
     * @param string $deviceName
     * @return array<string, User|string>
     * @throws InvalidCredentialsException
     */
    public function __invoke(string $username, string $password, string $deviceName): array
    {
        $user = User::query();
        $user = $user
            ->where("username", "=", $username)
            ->first();
        if (is_null($user) || !Hash::check($password, $user->password)) {
            throw new InvalidCredentialsException();
        }
        $token = $user->createToken(Carbon::now() . $deviceName);
        return ["token" => $token->plainTextToken, "user" => $user];
    }

}
