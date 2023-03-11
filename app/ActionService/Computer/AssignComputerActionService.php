<?php

namespace App\ActionService\Computer;

use App\Action\Computer\ComputerAssignAction;
use App\Action\Computer\ComputerUnassignAction;
use App\ActionService\AbstractActionService;
use App\Models\Computer;
use App\Models\User;
use App\Service\GuacamoleUserLoginService;

class AssignComputerActionService extends AbstractActionService
{
    public function __construct(
        private readonly ComputerAssignAction $computerAssignAction,
        private readonly ComputerUnassignAction $computerUnassignAction
    ) {
        parent::__construct();
    }

    public function __invoke(Computer $computer, User $user, bool $assign = true)
    {
        (new GuacamoleUserLoginService())();
        if ($assign) {
            ($this->computerAssignAction)($computer, $user);
        } else {
            ($this->computerUnassignAction)($computer, $user);
        }
        return ($this->responder)();
    }
}
