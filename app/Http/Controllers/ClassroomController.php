<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    //

    function list(): JsonResponse
    {

        return response()->json("todo");
    }

    // select classroom (instructor)
    function select(): JsonResponse
    {

        return response()->json("todo");
    }

    // select instructor (student)
    function assign(): JsonResponse
    {

        return response()->json("todo");
    }

    // import students from csv
    function import(): JsonResponse
    {

        return response()->json("todo");
    }

    // start class and set remaining time
    function start(): JsonResponse
    {

        return response()->json("todo");
    }

    // end class
    function end(): JsonResponse
    {

        return response()->json("todo");
    }

    // get remaining time
    function getRemainingTime(): JsonResponse
    {

        return response()->json("todo");
    }

    // update time
    function updateTime(): JsonResponse
    {

        return response()->json("todo");
    }
}
