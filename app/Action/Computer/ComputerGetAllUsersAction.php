<?php

namespace App\Action\Computer;

use App\Models\Computer;
use App\Models\User;
use App\Models\UsersComputers;

class ComputerGetAllUsersAction
{
    public function __invoke(User $user): array
    {
        $usersComputers = UsersComputers::where('user_id', $user->id)->get();
        $computers = [];
        foreach ($usersComputers as $usersComputer) {
            $computers[] = Computer::find($usersComputer->computer_id);
        }
        return $computers;
    }
}
