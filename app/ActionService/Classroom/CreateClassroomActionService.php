<?php

namespace App\ActionService\Classroom;

use App\Action\Classroom\ClassroomCreateAction;
use App\Action\Classroom\ClassroomExistsAction;
use App\Action\Login\GuacamoleAuthLoginAction;
use App\ActionService\AbstractActionService;
use App\Guacamole\Guacamole;
use App\Service\GuacamoleUserLoginService;
use App\Exceptions\ClassroomAlreadyExistsException;

class CreateClassroomActionService extends AbstractActionService
{
    public function __construct(
        private readonly ClassroomCreateAction $classroomCreateAction,
        private readonly ClassroomExistsAction $classroomExistsAction,
        private readonly Guacamole $guacamole,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
        private readonly GuacamoleAuthLoginAction $guacamoleAuthLoginAction
    ) {
        parent::__construct();
    }

    public function __invoke(array $classRoomCreateRequestData)
    {
        ($this->guacamoleUserLoginService)();
        $guacAuth = ($this->guacamoleAuthLoginAction)(env('GUACAMOLE_ADMIN'), env('GUACAMOLE_ADMIN_PASSWORD'));
        
        if (($this->classroomExistsAction)($classRoomCreateRequestData['name'])) {
            throw new ClassroomAlreadyExistsException();
        }
        $this->guacamole->getConnectionGroupEndpoint()->create($guacAuth, $classRoomCreateRequestData['name']);
        $newClass = ($this->classroomCreateAction)(
            $classRoomCreateRequestData['name'],
            $classRoomCreateRequestData['description'] ?? ''
        );
        
        return ($this->responder)(['classroom' => $newClass]);
    }
}
