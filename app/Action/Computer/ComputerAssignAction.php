<?php

namespace App\Action\Computer;

use App\Models\Computer;
use App\Models\User;

class ComputerAssignAction
{
    public function __invoke(Computer $computer, User $user): void
    {
        $computer->user_id = $user->id;
    }
}
