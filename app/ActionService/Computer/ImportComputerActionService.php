<?php

namespace App\ActionService\Computer;

use App\Action\Computer\ComputerImportAction;
use App\ActionService\AbstractActionService;
use App\Service\GuacamoleUserLoginService;

class ImportComputerActionService extends AbstractActionService
{
    public function __construct(
        private readonly ComputerImportAction $computerImportAction
    ) {
        parent::__construct();
    }

    public function __invoke(string $importStr)
    {
        (new GuacamoleUserLoginService())();
        ($this->computerImportAction)($importStr);
        return ($this->responder)();
    }
}
