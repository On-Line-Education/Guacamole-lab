<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    // get current
    function get(): JsonResponse
    {

        return response()->json("todo");
    }

    // get all
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

    function search(): JsonResponse
    {

        return response()->json("todo");
    }
}
