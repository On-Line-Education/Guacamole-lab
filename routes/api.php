<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\LectureController;
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
        Route::post('/', 'create')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);

        Route::get('/self', 'self')
            ->middleware([
                SystemAuth::AUTH,
            ]);
        Route::get('/all', 'list')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::get('/{user}', 'get')
            ->middleware([
                SystemAuth::AUTH
            ]);
        Route::patch('/{user}', 'edit')
            ->middleware([
                SystemAuth::AUTH
            ]);
        Route::delete('/{user}', 'delete')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::patch('/{user}/password', 'newPassword')
            ->middleware([
                SystemAuth::AUTH
            ]);
        Route::get('/search/{search}', 'search')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::post('/import', 'import')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
    });
});

Route::controller(ComputerController::class)->group(function () {
    Route::get('/classroom/computers', 'allComputers')
        ->middleware([
            SystemAuth::AUTH,
            SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
        ]);
    Route::post('/classroom/computers/import', 'import')
        ->middleware([
            SystemAuth::AUTH,
            SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
        ]);
    Route::get('/classroom/computers/{computer}/assign/{user}', 'assign') // to student
        ->middleware([
            SystemAuth::AUTH,
            SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
        ]);
    Route::get('/classroom/computers/{computer}/unassign/{user}', 'unassign') // from student
        ->middleware([
            SystemAuth::AUTH,
            SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
        ]);
    Route::prefix('/classroom/{classroom}/computer')->group(function () {
        Route::post('/', 'create')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::get('/all', 'list')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::get('/{computer}', 'get')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::patch('/{computer}', 'edit')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::delete('/{computer}', 'delete')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
    });
});

Route::controller(ClassroomController::class)->group(function () {
    Route::prefix('/classroom')->group(function () {
        Route::post('/', 'create')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::get('/all', 'list')
            ->middleware([
                SystemAuth::AUTH
            ]);
        Route::get('/all/with-instructors', 'withInstructors')
            ->middleware([
                SystemAuth::AUTH
            ]);
        Route::post('/student/select', 'select') // student select
            ->middleware([
                SystemAuth::AUTH
            ]);
        Route::post('/student/unselect', 'unselect') // student select
            ->middleware([
                SystemAuth::AUTH
            ]);
        Route::post('/instructor/assign', 'assign') // instructor select
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::post('/instructor/unassign', 'unassign') // instructor unselect
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::get('/{classRoom}', 'get')
            ->middleware([
                SystemAuth::AUTH
            ]);
        Route::patch('/{classRoom}', 'update')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::delete('/{classRoom}', 'delete')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
    });
});

Route::controller(StudentClassController::class)->group(function () {
    Route::prefix('/class')->group(function () {
        Route::get('/all', 'list')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::get('/{class}', 'get')
            ->middleware([
                SystemAuth::AUTH
            ]);
        Route::post('/', 'create')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::patch('/{class}', 'edit')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::delete('/{class}', 'delete')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::get('/{class}/add/{user}', 'add')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::get('/{class}/remove/{user}', 'remove')
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
    });
});

Route::controller(LectureController::class)->group(function () {
    Route::prefix('/lecture')->group(function () {
        Route::post('/start', 'start') // instructor start lecture
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::post('/end/{lecture}', 'end') // instructor end lecture
            ->middleware([
                SystemAuth::AUTH,
                SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
            ]);
        Route::post('/join/{lecture}', 'join') // student join lectore
            ->middleware([
                SystemAuth::AUTH
            ]);

        Route::prefix('/reserve')->group(function () {
            Route::post('/', 'reserve') // instructor reserve lecture
                ->middleware([
                    SystemAuth::AUTH,
                    SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
                ]);
            Route::patch('/{lecture}', 'editReservation') // instructor edit reservation
                ->middleware([
                    SystemAuth::AUTH,
                    SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
                ]);
            Route::delete('/{lecture}', 'deleteReservation') // instructor delete reservation
                ->middleware([
                    SystemAuth::AUTH,
                    SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
                ]);
            Route::get('/{user}', 'getInstructorReservations') // instructor get reservations
                ->middleware([
                    SystemAuth::AUTH,
                    SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
                ]);
            Route::get('/start/{user}', 'startReserved') // instructor start reserved
                ->middleware([
                    SystemAuth::AUTH,
                    SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
                ]);
            Route::get('/', 'getAllReservations') // instructor get all reservations
                ->middleware([
                    SystemAuth::AUTH,
                    SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
                ]);
        });

        Route::prefix('/time')->group(function () {
            Route::get('/', 'getRemainingTime') // get lecture remaining time
                ->middleware([
                    SystemAuth::AUTH
                ]);
            Route::patch('/update', 'updateTime')  // instructor update lecture time
                ->middleware([
                    SystemAuth::AUTH,
                    SystemPermissions::hasAtLeastOne(SystemPermissions::INSTRUCTOR)
                ]);
        });
    });
});
