<?php

namespace App\Action\Computer;

use App\Models\Computer;
use App\Models\User;

class ComputerUnassignAction
{
    public function __invoke(Computer $computer, User $user): void
    {
        if ($computer->user_id === $user->id) {
            $computer->user_id = null;
        }
    }
}
