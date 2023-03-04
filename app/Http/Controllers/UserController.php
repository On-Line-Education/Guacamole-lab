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
use Illuminate\Support\Facades\Auth;

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

    public function self(): JsonResponse
    {
        return ($this->readUserActionService)(user: Auth::user());
    }

    public function get(User $user): JsonResponse
    {
        return ($this->readUserActionService)(user: $user);
    }

    public function list(): JsonResponse
    {
        return ($this->readUserActionService)();
    }

    public function create(UserCreateRequest $userCreateRequest): JsonResponse
    {
        return ($this->createUserActionService)($userCreateRequest->all());
    }

    public function edit(User $user, UserUpdateRequest $userCreateRequest): JsonResponse
    {
        return ($this->updateUserActionService)($user, $userCreateRequest->all());
    }

    public function newPassword(User $user, UserNewPasswordRequest $userNewPasswordRequest): JsonResponse
    {
        return ($this->updateUserPasswordActionService)($user, $userNewPasswordRequest->all());
    }

    public function delete(User $user): JsonResponse
    {
        return ($this->deleteUserActionService)($user);
    }

    public function search(string $search): JsonResponse
    {
        return ($this->readUserActionService)(search: $search);
    }
}
