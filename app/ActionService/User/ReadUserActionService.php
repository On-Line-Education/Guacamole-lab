<?php

namespace App\ActionService\User;

use App\Action\User\UserGetAllAction;
use App\Action\User\UserGetByIdAction;
use App\Action\User\UserSearchAction;
use App\ActionService\AbstractActionService;
use App\Models\User;
use App\Service\GuacamoleUserLoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class ReadUserActionService extends AbstractActionService
{
    public function __construct(
        private readonly UserGetByIdAction         $userGetByIdAction,
        private readonly UserGetAllAction          $userGetAllAction,
        private readonly UserSearchAction          $userSearchAction,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
    ) {
        parent::__construct();
    }

    public function __invoke(?User $user = null, ?string $search = null)
    {
        $guacAuth = ($this->guacamoleUserLoginService)($user);

        $users = [];
        if ($user !== null) {
            if (Auth::user()->isStudent() && $user->id !== Auth::id()) {
                throw new UnauthorizedException();
            }
            $guacUser = ($this->userGetByIdAction)($guacAuth, $user->username);
            return ($this->responder)($user->getUserWithGuacDataArray($guacUser));
        } elseif ($search !== null && !Auth::user()->isStudent()) {
            $users = ($this->userSearchAction)($guacAuth, $search);
        } elseif (!Auth::user()->isStudent()) {
            $users = ($this->userGetAllAction)($guacAuth);
        }
        foreach ($users as &$guacUser) {
            $guacUser->id = User::where('username', $guacUser->username)->first()?->id ?? null;
        }
        return ($this->responder)($users);
    }
}
