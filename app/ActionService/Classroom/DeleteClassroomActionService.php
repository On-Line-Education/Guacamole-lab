<?php

namespace App\ActionService\Classroom;

use App\Action\Classroom\ClassroomDeleteAction;
use App\Action\Login\GuacamoleAuthLoginAction;
use App\ActionService\AbstractActionService;
use App\Models\ClassRoom;
use App\Guacamole\Guacamole;
use App\Service\GuacamoleUserLoginService;

class DeleteClassroomActionService extends AbstractActionService
{
    public function __construct(
        private readonly ClassroomDeleteAction $classroomDeleteAction,
        private readonly Guacamole $guacamole,
        private readonly GuacamoleAuthLoginAction $guacamoleAuthLoginAction,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService
    ) {
        parent::__construct();
    }

    public function __invoke(ClassRoom $classRoom)
    {
        ($this->guacamoleUserLoginService)();
        $guacAuth = ($this->guacamoleAuthLoginAction)(env('GUACAMOLE_ADMIN'), env('GUACAMOLE_ADMIN_PASSWORD'));
        $this->guacamole->getConnectionGroupEndpoint()->delete($guacAuth, $classRoom->name);
        ($this->classroomDeleteAction)($classRoom->id);
        return ($this->responder)();
    }
}
