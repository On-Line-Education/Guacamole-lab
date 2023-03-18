<?php

namespace App\Http\Controllers;

use App\ActionService\StudentClass\AssignStudentClassToStudentActionService;
use App\ActionService\StudentClass\CreateStudentClassActionService;
use App\ActionService\StudentClass\DeleteStudentClassActionService;
use App\ActionService\StudentClass\ReadStudentClassActionService;
use App\ActionService\StudentClass\ReadUsersInStudentClassActionService;
use App\ActionService\StudentClass\UnassignStudentClassToStudentActionService;
use App\ActionService\StudentClass\UpdateStudentClassActionService;
use App\Http\Requests\StudentClassCreateRequest;
use App\Http\Requests\StudentClassUpdateRequest;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class StudentClassController extends Controller
{
    public function __construct(
        private readonly CreateStudentClassActionService $createStudentClassActionService,
        private readonly ReadStudentClassActionService $readStudentClassActionService,
        private readonly UpdateStudentClassActionService $updateStudentClassActionService,
        private readonly DeleteStudentClassActionService $deleteStudentClassActionService,
        private readonly AssignStudentClassToStudentActionService $assignStudentClassToStudentActionService,
        private readonly UnassignStudentClassToStudentActionService $unassignStudentClassToStudentActionService,
        private readonly ReadUsersInStudentClassActionService $readUsersInStudentClassActionService
    )
    {}

    public function get(StudentClass $class): JsonResponse
    {
        return ($this->readStudentClassActionService)($class);
    }

    public function list(): JsonResponse
    {
        return ($this->readStudentClassActionService)();
    }

    public function listUsers(StudentClass $class): JsonResponse
    {
        return ($this->readUsersInStudentClassActionService)($class);
    }

    public function create(StudentClassCreateRequest $studentClassCreateRequest): JsonResponse
    {
        return ($this->createStudentClassActionService)($studentClassCreateRequest->all());
    }

    public function edit(StudentClass $class, StudentClassUpdateRequest $studentClassUpdateRequest): JsonResponse
    {
        return ($this->updateStudentClassActionService)($class, $studentClassUpdateRequest->all());
    }

    public function delete(StudentClass $class): JsonResponse
    {

        return ($this->deleteStudentClassActionService)($class);
    }

    public function add(StudentClass $class, User $user): JsonResponse
    {
        return ($this->assignStudentClassToStudentActionService)($user, $class);
    }

    public function remove(StudentClass $class, User $user): JsonResponse
    {
        return ($this->unassignStudentClassToStudentActionService)($user, $class);
    }
}
