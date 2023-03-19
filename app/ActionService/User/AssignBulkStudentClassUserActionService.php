<?php

namespace App\ActionService\User;

use App\Action\User\UserBulkAssignStudentClassAssignAction;
use App\ActionService\AbstractActionService;
use App\Models\User;
use App\Service\GuacamoleUserLoginService;

class AssignBulkStudentClassUserActionService extends AbstractActionService
{
    public function __construct(
            private readonly UserBulkAssignStudentClassAssignAction $userBulkAssignStudentClassAssignAction
    ) {
        parent::__construct();
    }
    public function __invoke(User $user, array $classBulkUpdateRequestData)
    {
        (new GuacamoleUserLoginService())();
        ($this->userBulkAssignStudentClassAssignAction)(
            $user,
            $classBulkUpdateRequestData['groups'] ?? null
        );
        return ($this->responder)();
    }
}
