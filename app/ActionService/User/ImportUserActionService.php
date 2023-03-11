<?php

namespace App\ActionService\User;

use App\Action\User\UserImportAction;
use App\ActionService\AbstractActionService;
use App\Service\GuacamoleUserLoginService;

class ImportUserActionService extends AbstractActionService
{
    public function __construct(
        private readonly UserImportAction $userImportAction,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
    ) {
        parent::__construct();
    }

    public function __invoke(string $userImportRequestData)
    {
        $guacAuth = ($this->guacamoleUserLoginService)();
        ($this->userImportAction)($guacAuth, $userImportRequestData);
        return ($this->responder)();
    }
}
