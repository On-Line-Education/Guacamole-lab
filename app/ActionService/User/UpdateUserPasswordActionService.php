<?php

namespace App\ActionService\User;

use App\Action\User\UserPasswordUpdateAction;
use App\Http\Requests\UserNewPasswordRequest;
use App\Models\User;
use App\Responder\Responder;
use App\Service\GuacamoleUserLoginService;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserPasswordActionService
{
    public function __construct(
        private readonly UserPasswordUpdateAction  $userPasswordUpdateAction,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
        private readonly Responder                 $responder,
    )
    {
    }

    public function __invoke(User $user, UserNewPasswordRequest $userNewPasswordRequest)
    {
        $guacAuth = ($this->guacamoleUserLoginService)();

        $oldPassword = $userNewPasswordRequest->get('oldPassword');
        $newPassword = $userNewPasswordRequest->get('newPassword');
        if (!($this->userPasswordUpdateAction)($guacAuth, $user, $oldPassword, $newPassword)) {
            return ($this->responder)(
                status: Response::HTTP_BAD_REQUEST,
                message: "Invalid old password"
            );
        }

        return ($this->responder)();
    }
}
