<?php

namespace App\Action\User;

use App\Guacamole\Guacamole;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Models\Computer;
use App\Models\GuacUserData;
use App\Models\StudentClasses;
use App\Models\User;

class UserDeleteAction
{

    public function __construct(
            private readonly Guacamole $guacamole
    )
    {}

    public function __invoke(GuacamoleAuthLoginData $guacamoleAuthLoginData, User $user): ?bool
    {
        $this->guacamole->getUser()->delete($guacamoleAuthLoginData, $user->username);
        Computer::where('user_id', $user->id)->update(['user_id' => null]);
        GuacUserData::where('user_id', $user->id)->delete();
        StudentClasses::where('student', $user->id)->delete();
        $user->delete();
        return true;
    }
}
