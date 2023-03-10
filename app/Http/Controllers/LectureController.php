<?php

namespace App\Http\Controllers;

use App\ActionService\Lecture\DeleteLectureActionService;
use App\ActionService\Lecture\ReadLectureActionService;
use App\ActionService\Lecture\ReserveLectureActionService;
use App\Http\Requests\LectureReservationCreateRequest;
use App\Models\Lecture;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class LectureController extends Controller
{
    
    public function __construct(
        public readonly ReadLectureActionService $readLectureActionService,
        public readonly ReserveLectureActionService $reserveLectureActionService,
        public readonly DeleteLectureActionService $deleteLectureActionService
    ) {
    }

    // start class and set remaining time
    public function start(): JsonResponse
    {
        return response()->json("todo");
    }

    // end class
    public function end(): JsonResponse
    {
        return response()->json("todo");
    }

    // student join lectore
    public function join(): JsonResponse
    {
        return response()->json("todo");
    }

    // instructor reserve lecture
    public function reserve(LectureReservationCreateRequest $lectureReservationCreateRequest): JsonResponse
    {
        return ($this->reserveLectureActionService)($lectureReservationCreateRequest->all());
    }
    
    // instructor edit reservation
    public function editReservation(): JsonResponse
    {
        return response()->json("todo");
    }
    
    // instructor delete reservation
    public function deleteReservation(Lecture $lecture): JsonResponse
    {
        return ($this->deleteLectureActionService)($lecture);
    }
    
    // instructor get reservations
    public function getInstructorReservations(User $user): JsonResponse
    {
        return ($this->readLectureActionService)(user: $user);
    }
    
    // instructor start reserved
    public function startReserved(): JsonResponse
    {
        return response()->json("todo");
    }
    
    // instructor get all reservations
    public function getAllReservations(): JsonResponse
    {
        return ($this->readLectureActionService)();
    }

    // get remaining time
    public function getRemainingTime(): JsonResponse
    {
        return response()->json("todo");
    }

    // update time
    public function updateTime(): JsonResponse
    {
        return response()->json("todo");
    }
}
