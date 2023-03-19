<?php

namespace App\ActionService\StudentClass;

use App\Action\StudentClass\StudentClassAssignBulkUserAction;
use App\Action\StudentClass\StudentClassUpdateAction;
use App\ActionService\AbstractActionService;
use App\Models\StudentClass;
use App\Service\GuacamoleUserLoginService;

class AssignBulkStudentClassActionService extends AbstractActionService
{
    public function __construct(
            private readonly StudentClassAssignBulkUserAction $studentClassAssignBulkUserAction
    ) {
        parent::__construct();
    }
    public function __invoke(StudentClass $class, array $classBulkUpdateRequestData)
    {
        (new GuacamoleUserLoginService())();
        ($this->studentClassAssignBulkUserAction)(
            $class,
            $classBulkUpdateRequestData['users'] ?? null
        );
        return ($this->responder)();
    }
}
