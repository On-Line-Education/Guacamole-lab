<?php

namespace App\Http\Controllers;

use App\ActionService\User\CreateUserActionService;
use App\ActionService\User\DeleteUserActionService;
use App\ActionService\User\ReadUserActionService;
use App\ActionService\User\UpdateUserActionService;
use App\ActionService\User\UpdateUserPasswordActionService;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserNewPasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
            private readonly CreateUserActionService $createUserActionService,
            private readonly ReadUserActionService $readUserActionService,
            private readonly UpdateUserActionService $updateUserActionService,
            private readonly DeleteUserActionService $deleteUserActionService,
            private readonly UpdateUserPasswordActionService $updateUserPasswordActionService
            )
    {}

    // get current
    function get(User $user): JsonResponse
    {
        return ($this->readUserActionService)(user: $user);
    }

    // get all
    function list(): JsonResponse
    {
        return ($this->readUserActionService)();
    }

    function create(UserCreateRequest $userCreateRequest): JsonResponse
    {
        return ($this->createUserActionService)($userCreateRequest);
    }

    function edit(UserUpdateRequest $userCreateRequest): JsonResponse
    {
        return ($this->updateUserActionService)($userCreateRequest);
    }

    function newPassword(User $user, UserNewPasswordRequest $userNewPasswordRequest): JsonResponse
    {
        return ($this->updateUserPasswordActionService)($user, $userNewPasswordRequest);
    }

    function delete(User $user): JsonResponse
    {
        return ($this->deleteUserActionService)($user);
    }

    function search(string $search): JsonResponse
    {
        return ($this->readUserActionService)(search: $search);
    }
}
