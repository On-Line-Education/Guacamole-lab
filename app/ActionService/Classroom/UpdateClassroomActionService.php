<?php

namespace App\ActionService\Classroom;

use App\Action\Classroom\ClassroomUpdateAction;
use App\ActionService\AbstractActionService;
use App\Models\ClassRoom;

class UpdateClassroomActionService extends AbstractActionService
{
    public function __construct(
            private readonly ClassroomUpdateAction $classroomUpdateAction
    ) {
        parent::__construct();
    }
    public function __invoke(ClassRoom $classRoom, array $classRoomUpdateRequestData)
    {
        $updated = ($this->classroomUpdateAction)(
                $classRoom->id,
                $classRoomUpdateRequestData['title'] ?? null,
                $classRoomUpdateRequestData['description'] ?? null
            );
        return ($this->responder)(['classroom' => $updated]);
    }
}
