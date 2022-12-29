<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    function login(): JsonResponse
    {

        return response()->json("todo");
    }


    function logout(): JsonResponse
    {

        return response()->json("todo");
    }
}
