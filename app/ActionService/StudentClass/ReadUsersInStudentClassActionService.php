<?php

namespace App\ActionService\StudentClass;

use App\Action\StudentClass\StudentClassGetAllAction;
use App\Action\StudentClass\StudentClassGetAllUsersAction;
use App\ActionService\AbstractActionService;
use App\Models\StudentClass;
use App\Service\GuacamoleUserLoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class ReadUsersInStudentClassActionService extends AbstractActionService
{
    public function __construct(
            private readonly StudentClassGetAllUsersAction $getAllUsersAction
    ) {
        parent::__construct();
    }

    public function __invoke(StudentClass $class)
    {
        (new GuacamoleUserLoginService())();
        
        $users = ($this->getAllUsersAction)($class);

        return ($this->responder)(['users' => $users]);
    }
}
