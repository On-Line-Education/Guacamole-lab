<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\System\SystemAuth;
use App\System\SystemPermissions;
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

Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')
        ->middleware([SystemAuth::AUTH]);
});

Route::controller(UserController::class)->group(function () {
    Route::prefix('/user')->group(function () {
        Route::get('/get/{user}', 'get')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::USER_DISPLAY)
            ]);
        Route::get('/all', 'list')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::USER_DISPLAY)
            ]);
        Route::post('/', 'create')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::USER_MODIFY)
            ]);
        Route::patch('/{user}', 'edit')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::USER_MODIFY)
            ]);
        Route::patch('/{user}/password', 'newPassword')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::USER_MODIFY)
            ]);
        Route::delete('/{user}', 'delete')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::USER_MODIFY)
            ]);
        Route::get('/search/{search}', 'search')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::USER_DISPLAY)
            ]);
    });
});

Route::controller(ClassroomController::class)->group(function () {
    Route::prefix('/classroom')->group(function () {
        Route::get('/', 'list')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_DISPLAY)
            ]);
        Route::get('/{classRoom}', 'get')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_DISPLAY)
            ]);
        Route::post('/', 'create')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_MODIFY)
            ]);
        Route::patch('/{classRoom}', 'update')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_MODIFY)
            ]);
        Route::delete('/{classRoom}', 'delete')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_MODIFY)
            ]);
        Route::post('/select', 'select')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_DISPLAY)
            ]);
        Route::post('/assign', 'assign')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_MODIFY)
            ]);
        Route::post('/{classroom}/import', 'import')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_MODIFY)
            ]);
        Route::post('/{classroom}/start', 'start')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_MODIFY)
            ]);
        Route::post('/{classroom}/end', 'end')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_MODIFY)
            ]);

        Route::prefix('/{classroom}/time')->group(function () {
            Route::get('/', 'getRemainingTime')
                ->middleware([
                    SystemAuth::AUTH,
                    SystemPermissions::hasAll(SystemPermissions::CLASSROOM_TIME)
                ]);
            Route::patch('/update', 'updateTime')
                ->middleware([
                    SystemAuth::AUTH,
                    SystemPermissions::hasAll(SystemPermissions::CLASSROOM_TIME_MODIFY)
                ]);
        });

        Route::prefix('/{classroom}/computer')->group(function () {
            Route::get('/', 'list')
                ->middleware([
                    SystemAuth::AUTH,
                    SystemPermissions::hasAll(SystemPermissions::CLASSROOM_COMPUTER_DISPLAY)
                ]);
            Route::post('/', 'create')
                ->middleware([
                    SystemAuth::AUTH,
                    SystemPermissions::hasAll(SystemPermissions::CLASSROOM_COMPUTER_MODIFY)
                ]);
            Route::patch('/', 'edit')
                ->middleware([
                    SystemAuth::AUTH,
                    SystemPermissions::hasAll(SystemPermissions::CLASSROOM_COMPUTER_MODIFY)
                ]);
            Route::delete('/', 'delete')
                ->middleware([
                    SystemAuth::AUTH,
                    SystemPermissions::hasAll(SystemPermissions::CLASSROOM_COMPUTER_MODIFY)
                ]);
            Route::post('/assign', 'assign')
                ->middleware([
                    SystemAuth::AUTH,
                    SystemPermissions::hasAll(SystemPermissions::CLASSROOM_COMPUTER_MODIFY)
                ]);
            Route::post('/import', 'import')
                ->middleware([
                    SystemAuth::AUTH,
                    SystemPermissions::hasAll(SystemPermissions::CLASSROOM_COMPUTER_MODIFY)
                ]);
        });
    });
});

Route::controller(GroupController::class)->group(function () {
    Route::prefix('/group')->group(function () {
        Route::get('/', 'list')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::GROUP_DISPLAY)
            ]);
        Route::post('/', 'create')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::GROUP_MODIFY)
            ]);
        Route::patch('/', 'edit')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::GROUP_MODIFY)
            ]);
        Route::delete('/', 'delete')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::GROUP_MODIFY)
            ]);
        Route::post('/add', 'add')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::GROUP_MODIFY)
            ]);
        Route::post('/remove', 'remove')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::GROUP_MODIFY)
            ]);
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
