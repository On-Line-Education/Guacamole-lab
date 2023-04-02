<?php

namespace App\ActionService\StudentClass;

use App\Action\StudentClass\StudentClassGetAllUsersAction;
use App\ActionService\AbstractActionService;
use App\Models\StudentClass;
use App\Service\GuacamoleUserLoginService;

class ReadUsersInStudentClassActionService extends AbstractActionService
{
    public function __construct(
        private readonly StudentClassGetAllUsersAction $getAllUsersAction,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService
    ) {
        parent::__construct();
    }

    public function __invoke(StudentClass $class)
    {
        ($this->guacamoleUserLoginService)();

        $users = ($this->getAllUsersAction)($class);

        return ($this->responder)(['users' => $users]);
    }
}
