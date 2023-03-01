<?php

namespace App\Action\User;

use App\Guacamole\Guacamole;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserPasswordUpdateAction
{

    public function __construct(
            private readonly Guacamole $guacamole
    )
    {}

    public function __invoke(
        GuacamoleAuthLoginData $guacamoleAuthLoginData,
        User $user,
        string $oldPassword,
        string $newPassword
        ): bool
    {
        if (!Hash::check($oldPassword, $user->password)) {
            return false;
        }

        $this->guacamole->getUser()->updatePassword(
            $guacamoleAuthLoginData,
            $user->username,
            $oldPassword,
            $newPassword
        );

        $user->password = Hash::make($newPassword);
        $user->save();
        return true;
    }
}
