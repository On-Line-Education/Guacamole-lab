<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class LectureController extends Controller
{
    
    public function __construct(
    )
    {}

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
