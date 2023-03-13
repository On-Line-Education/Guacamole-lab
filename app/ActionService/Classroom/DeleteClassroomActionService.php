<?php

namespace App\ActionService\Classroom;

use App\Action\Classroom\ClassroomDeleteAction;
use App\ActionService\AbstractActionService;
use App\Models\ClassRoom;
use App\Guacamole\Guacamole;
use App\Service\GuacamoleUserLoginService;

class DeleteClassroomActionService extends AbstractActionService
{
    public function __construct(
        private readonly ClassroomDeleteAction $classroomDeleteAction,
        private readonly Guacamole $guacamole,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService
    ) {
        parent::__construct();
    }

    public function __invoke(ClassRoom $classRoom)
    {
        $guacAuth = ($this->guacamoleUserLoginService)();
        $this->guacamole->getConnectionGroupEndpoint()->delete($guacAuth, $classRoom->name);
        ($this->classroomDeleteAction)($classRoom->id);
        return ($this->responder)();
    }
}
