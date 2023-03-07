<?php

namespace App\Action\Computer;

use App\Models\Computer;
use App\Models\User;
use App\Models\UsersComputers;

class ComputerAssignAction
{
    public function __invoke(Computer $computer, User $user): void
    {
        if (
            UsersComputers::where([
            ['user_id', '=', $user->id],
            ['computer_id', '=', $computer->id]
            ])->count() > 0
        ) {
            return;
        }
        
        $usersComputers = new UsersComputers();
        $usersComputers->user_id = $user->id;
        $usersComputers->computer_id = $computer->id;
        $usersComputers->save();
    }
}
