<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\StudentClassController;
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

Route::controller(ComputerController::class)->group(function () {
    Route::get('/classroom/computers', 'allComputers')
        ->middleware([
            SystemAuth::AUTH,
            SystemPermissions::hasAll(SystemPermissions::CLASSROOM_COMPUTER_DISPLAY)
        ]);
    Route::prefix('/classroom/{classroom}/computer')->group(function () {
        Route::get('/all', 'list')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_COMPUTER_DISPLAY)
            ]);
        Route::get('/{computer}', 'get')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_COMPUTER_DISPLAY)
            ]);
        Route::post('/', 'create')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_COMPUTER_MODIFY)
            ]);
        Route::patch('/{computer}', 'edit')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_COMPUTER_MODIFY)
            ]);
        Route::delete('/{computer}', 'delete')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_COMPUTER_MODIFY)
            ]);
        Route::post('/{computer}/assign', 'assign')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::CLASSROOM_COMPUTER_MODIFY)
            ]);
        Route::post('/{computer}/unassign', 'unassign')
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

Route::controller(ClassroomController::class)->group(function () {
    Route::prefix('/classroom')->group(function () {
        Route::get('/all', 'list')
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
        Route::post('/unassign', 'unassign')
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
    });
});

Route::controller(StudentClassController::class)->group(function () {
    Route::prefix('/class')->group(function () {
        Route::get('/all', 'list')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::GROUP_DISPLAY)
            ]);
        Route::get('/{class}', 'get')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::GROUP_DISPLAY)
            ]);
        Route::post('/', 'create')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::GROUP_MODIFY)
            ]);
        Route::patch('/{class}', 'edit')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAll(SystemPermissions::GROUP_MODIFY)
            ]);
        Route::delete('/{class}', 'delete')
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
