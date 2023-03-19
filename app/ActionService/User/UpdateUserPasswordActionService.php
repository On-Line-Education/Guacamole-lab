<?php

namespace App\ActionService\User;

use App\Action\User\UserPasswordUpdateAction;
use App\ActionService\AbstractActionService;
use App\Exceptions\InvalidOldPasswordException;
use App\Models\User;
use App\Service\GuacamoleUserLoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class UpdateUserPasswordActionService extends AbstractActionService
{
    public function __construct(
        private readonly UserPasswordUpdateAction  $userPasswordUpdateAction,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService
    ) {
        parent::__construct();
    }

    /**
     * @param User $user
     * @param array $userNewPasswordRequestData
     * @return JsonResponse
     * @throws InvalidOldPasswordException
     */
    public function __invoke(User $user, array $userNewPasswordRequestData): JsonResponse
    {
        if (Auth::user()->isStudent() && Auth::id() !== $user->id) {
            throw new UnauthorizedException();
        }

        $guacAuth = ($this->guacamoleUserLoginService)();
        $oldPassword = $userNewPasswordRequestData['oldPassword'];
        $newPassword = $userNewPasswordRequestData['newPassword'];
        if (!($this->userPasswordUpdateAction)($guacAuth, $user, $oldPassword, $newPassword)) {
            throw new InvalidOldPasswordException();
        }

        return ($this->responder)();
    }
}
