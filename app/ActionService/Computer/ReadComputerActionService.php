<?php

namespace App\ActionService\Computer;

use App\Action\Computer\ComputerGetAllAction;
use App\Action\Computer\ComputerGetAllInClassAction;
use App\ActionService\AbstractActionService;
use App\Models\ClassRoom;
use App\Models\Computer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReadComputerActionService extends AbstractActionService
{
    public function __construct(
        private readonly ComputerGetAllAction $computerGetAllAction,
        private readonly ComputerGetAllInClassAction $computerGetAllInClassAction
    ) {
        parent::__construct();
    }

    public function __invoke(?ClassRoom $classRoom = null, ?Computer $computer = null)
    {
        if (!is_null($computer) && !is_null($classRoom)) {
            if ($classRoom->id !== $computer->class_room_id) {
                throw new NotFoundHttpException();
            }
            $computers = ['computer' => $computer];
        } elseif (!is_null($classRoom)) {
            $computers = ['computers' => ($this->computerGetAllInClassAction)($classRoom)];
        } elseif (is_null($computer) && is_null($classRoom)) {
            $computers = ['computers' => ($this->computerGetAllAction)()];
        } else {
            $computers = [];
        }

        return ($this->responder)($computers);
    }
}
