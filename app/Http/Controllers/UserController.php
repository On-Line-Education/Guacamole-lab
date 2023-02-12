<?php

namespace App\Http\Controllers;

use App\ActionService\User\CreateUserActionService;
use App\ActionService\User\DeleteUserActionService;
use App\ActionService\User\ReadUserActionService;
use App\ActionService\User\UpdateUserActionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
            private readonly CreateUserActionService $createUserActionService,
            private readonly ReadUserActionService $readUserActionService,
            private readonly UpdateUserActionService $updateUserActionService,
            private readonly DeleteUserActionService $deleteUserActionService,
            )
    {}

    // get current
    function get(): JsonResponse
    {
        return ($this->readUserActionService)();
    }

    // get all
    function list(): JsonResponse
    {
        return ($this->readUserActionService)();
    }

    function create(): JsonResponse
    {
        ($this->createUserActionService)();
        return response()->json("todo");
    }

    function edit(): JsonResponse
    {
        ($this->updateUserActionService)();
        return response()->json("todo");
    }

    function delete(): JsonResponse
    {
        ($this->deleteUserActionService)();
        return response()->json("todo");
    }

    function search(): JsonResponse
    {
        ($this->readUserActionService)();
        return response()->json("todo");
    }
}
