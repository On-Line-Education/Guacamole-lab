<?php

namespace App\ActionService\Computer;

use App\Action\Computer\ComputerCreateAction;
use App\ActionService\AbstractActionService;
use App\Models\ClassRoom;

class CreateComputerActionService extends AbstractActionService
{
    public function __construct(
        private readonly ComputerCreateAction $computerCreateAction
    ) {
        parent::__construct();
    }

    public function __invoke(ClassRoom $classRoom, array $computerCreateRequestData)
    {
        $newComputer = ($this->computerCreateAction)(
            $computerCreateRequestData['name'],
            $computerCreateRequestData['ip'],
            $computerCreateRequestData['mac'],
            $computerCreateRequestData['login'],
            $classRoom->id
        );
        return ($this->responder)(['computer' => $newComputer]);
    }
}
