<?php

namespace App\ActionService\Classroom;

use App\Action\Classroom\ClassroomGetAllAction;
use App\Action\Classroom\ClassroomGetAllWithInstructorsAction;
use App\ActionService\AbstractActionService;
use App\Models\ClassRoom;

class ReadClassroomActionService extends AbstractActionService
{
    public function __construct(
        private readonly ClassroomGetAllAction $classroomGetAllAction,
        private readonly ClassroomGetAllWithInstructorsAction $classroomGetAllWithInstructorsAction
    ) {
        parent::__construct();
    }

    public function __invoke(?ClassRoom $classRoom = null, bool $withInstructors = false)
    {
        $classrooms = [];

        if ($withInstructors) {
            $classrooms = ($this->classroomGetAllWithInstructorsAction)();
        } elseif ($classRoom !== null) {
            $classrooms = ['classroom' => $classRoom];
        } else {
            $classrooms = ['classrooms' => ($this->classroomGetAllAction)()];
        }

        return ($this->responder)($classrooms);
    }
}
