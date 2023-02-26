<?php

namespace App\Http\Controllers;

use App\ActionService\StudentClass\CreateStudentClassActionService;
use App\ActionService\StudentClass\DeleteStudentClassActionService;
use App\ActionService\StudentClass\ReadStudentClassActionService;
use App\ActionService\StudentClass\UpdateStudentClassActionService;
use App\Http\Requests\StudentClassCreateRequest;
use App\Http\Requests\StudentClassUpdateRequest;
use App\Models\StudentClass;
use Illuminate\Http\JsonResponse;

class StudentClassController extends Controller
{
    public function __construct(
            private readonly CreateStudentClassActionService $createStudentClassActionService,
            private readonly ReadStudentClassActionService $readStudentClassActionService,
            private readonly UpdateStudentClassActionService $updateStudentClassActionService,
            private readonly DeleteStudentClassActionService $deleteStudentClassActionService
            ) {
    }

    function get(StudentClass $class): JsonResponse
    {
        return ($this->readStudentClassActionService)($class);
    }

    function list(): JsonResponse
    {
        return ($this->readStudentClassActionService)();
    }

    function create(StudentClassCreateRequest $studentClassCreateRequest): JsonResponse
    {
        return ($this->createStudentClassActionService)($studentClassCreateRequest->all());
    }

    function edit(StudentClass $class, StudentClassUpdateRequest $studentClassUpdateRequest): JsonResponse
    {
        return ($this->updateStudentClassActionService)($class, $studentClassUpdateRequest->all());
    }

    function delete(StudentClass $class): JsonResponse
    {

        return ($this->deleteStudentClassActionService)($class);
    }

    function add(): JsonResponse
    {

        return response()->json("todo");
    }

    function remove(): JsonResponse
    {

        return response()->json("todo");
    }
}
