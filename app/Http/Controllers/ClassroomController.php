<?php

namespace App\Http\Controllers;

use App\ActionService\Classroom\CreateClassroomActionService;
use App\ActionService\Classroom\DeleteClassroomActionService;
use App\ActionService\Classroom\ReadClassroomActionService;
use App\ActionService\Classroom\UpdateClassroomActionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        ($this->readClassroomActionService)();
        return response()->json("todo");
    }

    // select classroom (instructor)
    function select(): JsonResponse
    {
        ($this->readClassroomActionService)();
        return response()->json("todo");
    }

    // select instructor (student)
    function assign(): JsonResponse
    {
        ($this->updateClassroomActionService)();
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
