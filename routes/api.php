<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/login", [LoginController::class, "login"]);
Route::get("/logout", [LoginController::class, "logout"]);

Route::prefix("/user")->group(function() {
    Route::get("/", [UserController::class, "get"]);
    Route::get("/all", [UserController::class, "list"]);
    Route::post("/", [UserController::class, "create"]);
    Route::patch("/", [UserController::class, "edit"]);
    Route::delete("/", [UserController::class, "delete"]);
    Route::get("/search", [UserController::class, "search"]);
});

Route::prefix("/classroom")->group(function() {

    Route::get("/", [ClassroomController::class, "list"]);
    Route::post("/select", [ClassroomController::class, "select"]);
    Route::post("/assign", [ClassroomController::class, "assign"]);
    Route::post("/{classroom}/import", [ClassroomController::class, "import"]);
    Route::post("/{classroom}/start", [ClassroomController::class, "start"]);
    Route::post("/{classroom}/end", [ClassroomController::class, "end"]);

    Route::prefix("/{classroom}/time")->group(function (){
        Route::get("/", [ClassroomController::class, "getRemainingTime"]);
        Route::patch("/update", [ClassroomController::class, "updateTime"]);
    });

    Route::prefix("/{classroom}/computer")->group(function (){
        Route::get("/", [ComputerController::class, "list"]);
        Route::post("/", [ComputerController::class, "create"]);
        Route::patch("/", [ComputerController::class, "edit"]);
        Route::delete("/", [ComputerController::class, "delete"]);
        Route::post("/assign", [ComputerController::class, "assign"]);
        Route::post("/import", [ComputerController::class, "import"]);
    });
});

Route::prefix("/group")->group(function (){
    Route::get("/", [GroupController::class, "list"]);
    Route::post("/", [GroupController::class, "create"]);
    Route::patch("/", [GroupController::class, "edit"]);
    Route::delete("/", [GroupController::class, "delete"]);
    Route::post("/add", [GroupController::class, "add"]);
    Route::post("/remove", [GroupController::class, "remove"]);
});





//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::get("/test", function () {
//
//
//    return response()->json(
//        ["response" => \App\Guacamole\GuacamoleHelper::generateSessionConnectionUrl(1, "postgresql")]
//    );
//});

//Route::get('/test/guac/connect', function () {
//    $g = new \App\Guacamole\GuacamoleLogin();
//    $userConn = $g->connectUser("guacadmin", "guacadmin");
//    $user = \App\Guacamole\GuacamoleUser::getUserDetails($userConn, "test");
//
//    return response()->json([
//        'response' => $userConn,
//        'user' => $user
//    ]);
//});
