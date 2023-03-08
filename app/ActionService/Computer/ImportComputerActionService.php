<?php

namespace App\ActionService\Computer;

use App\Action\Computer\ComputerCreateAction;
use App\Action\Computer\ComputerImportAction;
use App\ActionService\AbstractActionService;
use App\Models\ClassRoom;

class ImportComputerActionService extends AbstractActionService
{
    public function __construct(
        private readonly ComputerImportAction $computerImportAction
    ) {
        parent::__construct();
    }

    public function __invoke(string $importStr)
    {
        ($this->computerImportAction)($importStr);
        return ($this->responder)();
    }
}
