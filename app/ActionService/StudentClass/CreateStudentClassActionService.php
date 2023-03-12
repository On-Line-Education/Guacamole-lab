<?php

namespace App\ActionService\StudentClass;

use App\Action\StudentClass\StudentClassCreateAction;
use App\ActionService\AbstractActionService;
use App\Service\GuacamoleUserLoginService;

class CreateStudentClassActionService extends AbstractActionService
{
    public function __construct(
            private readonly StudentClassCreateAction $classCreateAction
    ) {
        parent::__construct();
    }

    public function __invoke(array $classCreateRequestData)
    {
        (new GuacamoleUserLoginService())();
        $newClass = ($this->classCreateAction)(
                $classCreateRequestData['name']
        );
        return ($this->responder)(['class' => $newClass]);
    }
}
