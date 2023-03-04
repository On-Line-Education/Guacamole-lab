<?php

namespace App\ActionService\Computer;

use App\Action\Computer\ComputerUpdateAction;
use App\ActionService\AbstractActionService;
use App\Exceptions\InvalidClassroomForSelectedComputerException;
use App\Models\ClassRoom;
use App\Models\Computer;

class UpdateComputerActionService extends AbstractActionService
{
    public function __construct(
        private readonly ComputerUpdateAction $computerUpdateAction
    ) {
        parent::__construct();
    }
    public function __invoke(ClassRoom $classRoom, Computer $computer, array $computerUpdateRequestData)
    {
        if ($classRoom->id !== $computer->class_room_id) {
            throw new InvalidClassroomForSelectedComputerException();
        }
        
        $updated = ($this->computerUpdateAction)(
            $computer->id,
            $computerUpdateRequestData['name'] ?? null,
            $computerUpdateRequestData['ip'] ?? null,
            $computerUpdateRequestData['mac'] ?? null,
            $computerUpdateRequestData['login'] ?? null,
        );
        return ($this->responder)(['computer' => $updated]);
    }
}