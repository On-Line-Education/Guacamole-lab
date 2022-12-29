<?php

use App\Http\Controllers\LoginController;
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
    Route::get("/", function(){
        // get all
    });
    Route::post("/", function(){
        // create
    });
    Route::patch("/", function(){
        // edit
    });
    Route::delete("/", function(){
        // delete
    });
    Route::get("/search", function(){
        // search users
    });
});

Route::prefix("/classroom")->group(function() {
    Route::post("/select", function(){
        // select classroom (instructor)
    });
    Route::post("/assign", function(){
        // select instructor (student)
    });
    Route::post("/{classroom}/import", function(){
        // import students from csv
    });
    Route::post("/{classroom}/start", function (){
       // start class and set remaining time
    });
    Route::post("/{classroom}/end", function (){
        // end class
    });

    Route::prefix("/{classroom}/time")->group(function (){
        Route::get("/", function (){
            // get remaining time
        });
        Route::patch("/update", function(){
            // update time
        });
    });

    Route::prefix("/{classroom}/computer")->group(function (){
        Route::get("/", function (){
            // get all
        });
        Route::post("/", function(){
            // create
        });
        Route::patch("/", function(){
            // edit
        });
        Route::delete("/", function(){
            // delete
        });
        Route::post("/assign", function(){
            // assign computer to student
        });
        Route::post("/import", function(){
            // import computers from csv
        });
    });
});

Route::prefix("/group")->group(function (){
    Route::get("/", function (){
        // get all
    });
    Route::post("/", function(){
        // create
    });
    Route::patch("/", function(){
        // edit
    });
    Route::delete("/", function(){
        // delete
    });
    Route::post("/add", function(){
        // add user to group
    });
    Route::post("/remove", function(){
        // remove user from group
    });
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
