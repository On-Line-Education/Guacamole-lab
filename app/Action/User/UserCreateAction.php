<?php

namespace App\Action\User;

use App\Guacamole\Guacamole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserCreateAction
{

    public function __construct(
        private readonly Guacamole $guacamole
    )
    {}

    public function __invoke(string $username, string $password, string $role): User
    {
        $sysUser = new User();
        $sysUser->username = $username;
        $sysUser->password = Hash::make($password);
        $sysUser->role = $role;
        $sysUser->save();
        return $sysUser;
    }
}
