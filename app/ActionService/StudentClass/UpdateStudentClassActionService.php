<?php

namespace App\ActionService\StudentClass;

use App\Action\StudentClass\StudentClassUpdateAction;
use App\ActionService\AbstractActionService;
use App\Models\StudentClass;

class UpdateStudentClassActionService extends AbstractActionService
{
    public function __construct(
            private readonly StudentClassUpdateAction $classUpdateAction
    ) {
        parent::__construct();
    }
    public function __invoke(StudentClass $class, array $classUpdateRequestData)
    {
        $updated = ($this->classUpdateAction)(
            $class->id,
            $classUpdateRequestData['name'] ?? null
        );
        return ($this->responder)(['class' => $updated]);
    }
}
