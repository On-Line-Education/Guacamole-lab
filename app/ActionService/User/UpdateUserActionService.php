<?php

namespace App\ActionService\User;

use App\Action\Login\GuacamoleAuthLoginAction;
use App\Action\User\UserUpdateAction;
use App\ActionService\AbstractActionService;
use App\Guacamole\Objects\User\GuacamoleUserData;
use App\Models\User;
use App\Service\GuacamoleUserLoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class UpdateUserActionService extends AbstractActionService
{
    public function __construct(
        private readonly UserUpdateAction          $userUpdateAction,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
        private readonly GuacamoleAuthLoginAction $guacamoleAuthLoginAction,
    ) {
        parent::__construct();
    }

    public function __invoke(User $user, array $userUpdateRequestData)
    {
        if (Auth::user()->isStudent() && Auth::id() !== $user->id) {
            throw new UnauthorizedException();
        }

        $password = null;
        if (Auth::user()->isAdmin()) {
            $password = $userUpdateRequestData['password'] ?? null;
        } 
        if (Auth::user()->isAdmin() || Auth::user()->isInstructor()){
            $guacAuth = ($this->guacamoleAuthLoginAction)(env('GUACAMOLE_ADMIN'), env('GUACAMOLE_ADMIN_PASSWORD'));
        } else {
            $guacAuth = ($this->guacamoleUserLoginService)();
        }
        $guacUser = new GuacamoleUserData($userUpdateRequestData);
        $guacUser->username = $user->username;
        ($this->userUpdateAction)($guacAuth, $guacUser, $password);
        
        if ($password !== null && Auth::user()->isAdmin()) {
            $user->password = Hash::make($password);
            $user->save();
        }
        return ($this->responder)();
    }
}
