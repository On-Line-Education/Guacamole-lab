<?php

namespace App\ActionService\User;

use App\Action\User\UserGetAllAction;
use App\Action\User\UserGetByIdAction;
use App\Action\User\UserSearchAction;
use App\ResponseFormatter\User\UsersGetResponseFormatter;
use App\Service\GuacamoleUserLoginService;

class ReadUserActionService
{
    public function __construct(
            private readonly UserGetByIdAction $userGetByIdAction,
            private readonly UserGetAllAction $userGetAllAction,
            private readonly UserSearchAction $userSearchAction,
            private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
            private readonly UsersGetResponseFormatter $usersListGetResponseFormatter
            )
    {}

    public function __invoke(?int $id = null, ?string $search = null)
    {
        $guacAuth = ($this->guacamoleUserLoginService)();

        $users = [];
        if ($id !== null) {
            $users[] = ($this->userGetByIdAction)($id);
        } else if ($search !== null) {
            $users = ($this->userSearchAction)($search);
        } else {
            $users = ($this->userGetAllAction)($guacAuth);
        }
        return ($this->usersListGetResponseFormatter)($users);
    }
}
