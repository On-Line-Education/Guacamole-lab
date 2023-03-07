<?php

namespace App\Action\Computer;

use App\Models\Computer;
use App\Models\User;
use App\Models\UsersComputers;

class ComputerUnassignAction
{
    public function __invoke(Computer $computer, User $user): void
    {
            UsersComputers::where([
            ['user_id', '=', $user->id],
            ['computer_id', '=', $computer->id]
            ])->delete();
    }
}
