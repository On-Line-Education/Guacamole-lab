<?php

namespace App\Http\Controllers;

use App\ActionService\Computer\AssignComputerActionService;
use App\ActionService\Computer\CreateComputerActionService;
use App\ActionService\Computer\DeleteComputerActionService;
use App\ActionService\Computer\ImportComputerActionService;
use App\ActionService\Computer\ReadComputerActionService;
use App\ActionService\Computer\UpdateComputerActionService;
use App\Http\Requests\ComputerCreateRequest;
use App\Http\Requests\ComputerImportRequest;
use App\Http\Requests\ComputerUpdateRequest;
use App\Models\ClassRoom;
use App\Models\Computer;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ComputerController extends Controller
{
    public function __construct(
        private readonly CreateComputerActionService $createComputerActionService,
        private readonly ReadComputerActionService $readComputerActionService,
        private readonly UpdateComputerActionService $updateComputerActionService,
        private readonly DeleteComputerActionService $deleteComputerActionService,
        private readonly AssignComputerActionService $assignComputerActionService,
        private readonly ImportComputerActionService $importComputerActionService
    )
    {}

    public function allComputers(): JsonResponse
    {
        return ($this->readComputerActionService)();
    }

    public function allUsersComputers(User $user): JsonResponse
    {
        return ($this->readComputerActionService)(user: $user);
    }

    public function list(ClassRoom $classroom): JsonResponse
    {
        return ($this->readComputerActionService)($classroom);
    }

    public function get(ClassRoom $classroom, Computer $computer): JsonResponse
    {
        return ($this->readComputerActionService)($classroom, $computer);
    }

    public function create(ClassRoom $classroom, ComputerCreateRequest $computerCreateRequest): JsonResponse
    {
        return ($this->createComputerActionService)($classroom, $computerCreateRequest->all());
    }

    public function edit(
        ClassRoom $classroom,
        Computer $computer,
        ComputerUpdateRequest $computerUpdateRequest
    ): JsonResponse
    {
        return ($this->updateComputerActionService)($classroom, $computer, $computerUpdateRequest->all());
    }

    public function delete(ClassRoom $classroom, Computer $computer): JsonResponse
    {
        return ($this->deleteComputerActionService)($classroom, $computer);
    }

    // assign computer to student
    public function assign(Computer $computer, User $user): JsonResponse
    {
        return ($this->assignComputerActionService)($computer, $user);
    }

    // assign computer to student
    public function unassign(Computer $computer, User $user): JsonResponse
    {
        return ($this->assignComputerActionService)($computer, $user, true);
    }

    // import computers from csv
    public function import(ComputerImportRequest $computerImportRequest): JsonResponse
    {
        return ($this->importComputerActionService)($computerImportRequest->file('import_csv')->get());
    }
}
