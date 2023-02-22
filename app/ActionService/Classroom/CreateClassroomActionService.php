<?php

namespace App\ActionService\Classroom;

use App\Action\Classroom\ClassroomCreateAction;
use App\ActionService\AbstractActionService;

class CreateClassroomActionService extends AbstractActionService
{
    public function __construct(
            private readonly ClassroomCreateAction $classroomCreateAction
            )
    {
    }

    public function __invoke(array $classRoomCreateRequestData)
    {
        $newClass = ($this->classroomCreateAction)(
                $classRoomCreateRequestData['name'],
                $classRoomCreateRequestData['description']
        );
        return ($this->responder)(['classroom' => $newClass]);
    }
}
