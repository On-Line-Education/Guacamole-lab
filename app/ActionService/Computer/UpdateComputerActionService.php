<?php

namespace App\ActionService\Computer;

use App\Action\Computer\ComputerUpdateAction;
use App\ActionService\AbstractActionService;
use App\Exceptions\InvalidClassroomForSelectedComputerException;
use App\Models\ClassRoom;
use App\Models\Computer;
use App\Service\GuacamoleUserLoginService;

class UpdateComputerActionService extends AbstractActionService
{
    public function __construct(
        private readonly ComputerUpdateAction $computerUpdateAction
    ) {
        parent::__construct();
    }
    public function __invoke(ClassRoom $classRoom, Computer $computer, array $computerUpdateRequestData)
    {
        (new GuacamoleUserLoginService())();
        if ($classRoom->id !== $computer->class_room_id) {
            throw new InvalidClassroomForSelectedComputerException();
        }
        
        $updated = ($this->computerUpdateAction)(
            $computer->id,
            $computerUpdateRequestData['name'] ?? null,
            $computerUpdateRequestData['ip'] ?? null,
            $computerUpdateRequestData['mac'] ?? null,
            $computerUpdateRequestData['broadcast'] ?? null,
            $computerUpdateRequestData['instructor'] ?? null,
        );
        return ($this->responder)(['computer' => $updated]);
    }
}
