<?php

namespace App\ActionService\Computer;

use App\Action\Computer\ComputerDeleteAction;
use App\ActionService\AbstractActionService;
use App\Models\ClassRoom;
use App\Models\Computer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeleteComputerActionService extends AbstractActionService
{
    public function __construct(
        private readonly ComputerDeleteAction $computerDeleteAction
    ) {
        parent::__construct();
    }

    public function __invoke(ClassRoom $classRoom, Computer $computer)
    {
        if ($classRoom->id !== $computer->class_room_id) {
            throw new NotFoundHttpException();
        }
        ($this->computerDeleteAction)($computer->id);
        return ($this->responder)();
    }
}
