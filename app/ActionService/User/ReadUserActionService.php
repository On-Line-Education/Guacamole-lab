<?php

namespace App\ActionService\User;

use App\Action\User\UserGetAllAction;
use App\Action\User\UserGetByIdAction;
use App\Action\User\UserSearchAction;
use App\ActionService\AbstractActionService;
use App\Models\User;
use App\Service\GuacamoleUserLoginService;

class ReadUserActionService extends AbstractActionService
{
    public function __construct(
        private readonly UserGetByIdAction         $userGetByIdAction,
        private readonly UserGetAllAction          $userGetAllAction,
        private readonly UserSearchAction          $userSearchAction,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
    ) {
    }

    public function __invoke(?User $user = null, ?string $search = null)
    {
        $guacAuth = ($this->guacamoleUserLoginService)($user);

        $users = [];
        if ($user !== null) {
            $guacUser = ($this->userGetByIdAction)($guacAuth, $user->id);
            $guacUser->id = $user->id;
            return ($this->responder)($guacUser);
        } else if ($search !== null) {
            $users[] = ($this->userSearchAction)($guacAuth, $search);
        } else {
            $users = ($this->userGetAllAction)($guacAuth);
        }
        foreach ($users as &$guacUser) {
            $guacUser->id = User::where('username', $guacUser->getUsername())->first()?->id ?? null;
        }
        return ($this->responder)($users);
    }
}
