<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    //

    function list(): JsonResponse
    {

        return response()->json("todo");
    }

    function create(): JsonResponse
    {

        return response()->json("todo");
    }

    function edit(): JsonResponse
    {

        return response()->json("todo");
    }

    function delete(): JsonResponse
    {

        return response()->json("todo");
    }

    // assign computer to student
    function assign(): JsonResponse
    {

        return response()->json("todo");
    }

    // import computers from csv
    function import(): JsonResponse
    {

        return response()->json("todo");
    }
}
