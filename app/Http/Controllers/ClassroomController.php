<?php

namespace App\Http\Controllers;

use App\ActionService\Classroom\CreateClassroomActionService;
use App\ActionService\Classroom\DeleteClassroomActionService;
use App\ActionService\Classroom\InstructorClassroomAssignActionService;
use App\ActionService\Classroom\ReadClassroomActionService;
use App\ActionService\Classroom\StudentClassroomAssignActionService;
use App\ActionService\Classroom\UpdateClassroomActionService;
use App\Http\Requests\ClassRoomCreateRequest;
use App\Http\Requests\ClassRoomUpdateRequest;
use App\Http\Requests\UserAssignRequest;
use App\Models\ClassRoom;
use Illuminate\Http\JsonResponse;

class ClassroomController extends Controller
{
    
    public function __construct(
        private readonly InstructorClassroomAssignActionService $instructorClassroomAssignActionService,
        private readonly StudentClassroomAssignActionService $studentClassroomAssignActionService,
        private readonly CreateClassroomActionService $createClassroomActionService,
        private readonly ReadClassroomActionService $readClassroomActionService,
        private readonly UpdateClassroomActionService $updateClassroomActionService,
        private readonly DeleteClassroomActionService $deleteClassroomActionService,
    )
    {}

    public function list(): JsonResponse
    {
        return ($this->readClassroomActionService)();
    }

    public function get(ClassRoom $classRoom)
    {
        return ($this->readClassroomActionService)($classRoom);
    }

    // create classroom
    public function create(ClassRoomCreateRequest $classRoomCreateRequest): JsonResponse
    {
        return ($this->createClassroomActionService)($classRoomCreateRequest->all());
    }

    // delete classroom
    public function delete(ClassRoom $classRoom): JsonResponse
    {
        return ($this->deleteClassroomActionService)($classRoom);
    }

    public function update(ClassRoom $classRoom, ClassRoomUpdateRequest $classRoomUpdateRequest): JsonResponse
    {
        return ($this->updateClassroomActionService)($classRoom, $classRoomUpdateRequest->all());
    }

    // select classroom (student) <- AssignActin
    public function select(UserAssignRequest $userAssignRequest): JsonResponse
    {
        return ($this->studentClassroomAssignActionService)(true, $userAssignRequest->all());
    }

    // select classroom (student) <- AssignActin
    public function unselect(UserAssignRequest $userAssignRequest): JsonResponse
    {
        return ($this->studentClassroomAssignActionService)(false, $userAssignRequest->all());
    }

    // select classroom (instructor) <- AssignActin
    public function assign(UserAssignRequest $userAssignRequest): JsonResponse
    {
        return ($this->instructorClassroomAssignActionService)(true, $userAssignRequest->all());
    }

    // select classroom (instructor) <- AssignActin
    public function unassign(UserAssignRequest $userAssignRequest): JsonResponse
    {
        return ($this->instructorClassroomAssignActionService)(false, $userAssignRequest->all());
    }

    // import students from csv
    public function import(): JsonResponse
    {
        // TODO: Import AS
        return response()->json("todo");
    }

    // start class and set remaining time
    public function start(): JsonResponse
    {
        // TODO: Time AS
        return response()->json("todo");
    }

    // end class
    public function end(): JsonResponse
    {
        // TODO: Time AS
        return response()->json("todo");
    }

    // get remaining time
    public function getRemainingTime(): JsonResponse
    {
        // TODO: Time AS
        return response()->json("todo");
    }

    // update time
    public function updateTime(): JsonResponse
    {
        // TODO: Time AS
        return response()->json("todo");
    }
}
