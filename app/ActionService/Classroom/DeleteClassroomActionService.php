<?php

namespace App\ActionService\Classroom;

use App\Action\Classroom\ClassroomDeleteAction;
use App\ActionService\AbstractActionService;
use App\Models\ClassRoom;

class DeleteClassroomActionService extends AbstractActionService
{
    public function __construct(
            private readonly ClassroomDeleteAction $classroomDeleteAction
            )
    {
    }

    public function __invoke(ClassRoom $classRoom)
    {
        ($this->classroomDeleteAction)($classRoom->id);
        return ($this->responder)();
    }
}
