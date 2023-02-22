<?php

namespace App\Http\Controllers;

use App\ActionService\Classroom\CreateClassroomActionService;
use App\ActionService\Classroom\DeleteClassroomActionService;
use App\ActionService\Classroom\ReadClassroomActionService;
use App\ActionService\Classroom\UpdateClassroomActionService;
use App\Http\Requests\ClassRoomCreateRequest;
use App\Http\Requests\ClassRoomUpdateRequest;
use App\Models\ClassRoom;
use Illuminate\Http\JsonResponse;

class ClassroomController extends Controller
{
    //
    public function __construct(
            private readonly CreateClassroomActionService $createClassroomActionService,
            private readonly ReadClassroomActionService $readClassroomActionService,
            private readonly UpdateClassroomActionService $updateClassroomActionService,
            private readonly DeleteClassroomActionService $deleteClassroomActionService,
        )
    {}

    function list(): JsonResponse
    {
        return ($this->readClassroomActionService)();
    }

    function get(ClassRoom $classRoom)
    {
        return ($this->readClassroomActionService)($classRoom);
    }

    // select classroom (instructor) <- AssignActin
    function select(): JsonResponse
    {
        return ($this->readClassroomActionService)();
    }

    // create classroom
    function create(ClassRoomCreateRequest $classRoomCreateRequest): JsonResponse
    {
        return ($this->createClassroomActionService)($classRoomCreateRequest->all());
    }

    // delete classroom
    function delete(ClassRoom $classRoom): JsonResponse
    {
        return ($this->deleteClassroomActionService)($classRoom);
    }

    function update(ClassRoom $classRoom, ClassRoomUpdateRequest $classRoomUpdateRequest): JsonResponse
    {
        return ($this->updateClassroomActionService)($classRoom, $classRoomUpdateRequest->all());
    }

    // select instructor (student) <- AssignActin
    function assign(): JsonResponse
    {
//        return ($this->updateClassroomActionService)();
        return response()->json("todo");
    }

    // import students from csv
    function import(): JsonResponse
    {
        // TODO: Import AS
        return response()->json("todo");
    }

    // start class and set remaining time
    function start(): JsonResponse
    {
        // TODO: Time AS
        return response()->json("todo");
    }

    // end class
    function end(): JsonResponse
    {
        // TODO: Time AS
        return response()->json("todo");
    }

    // get remaining time
    function getRemainingTime(): JsonResponse
    {
        // TODO: Time AS
        return response()->json("todo");
    }

    // update time
    function updateTime(): JsonResponse
    {
        // TODO: Time AS
        return response()->json("todo");
    }
}
