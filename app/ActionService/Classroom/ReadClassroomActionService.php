<?php

namespace App\ActionService\Classroom;

use App\Action\Classroom\ClassroomGetAllAction;
use App\ActionService\AbstractActionService;
use App\Models\ClassRoom;

class ReadClassroomActionService extends AbstractActionService
{
    public function __construct(
            private readonly ClassroomGetAllAction $classroomGetAllAction
    ) {
        parent::__construct();
    }

    public function __invoke(?ClassRoom $classRoom = null)
    {
        $classrooms = [];

        if (!is_null($classRoom)) {
            $classrooms = ['classroom' => $classRoom];
        } else {
            $classrooms = ['classrooms' => ($this->classroomGetAllAction)()];
        }

        return ($this->responder)($classrooms);
    }
}
