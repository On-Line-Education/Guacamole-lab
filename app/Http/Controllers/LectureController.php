<?php

namespace App\Http\Controllers;

use App\ActionService\Lecture\DeleteLectureActionService;
use App\ActionService\Lecture\ReadLectureActionService;
use App\ActionService\Lecture\ReserveLectureActionService;
use App\ActionService\Lecture\UpdateReserveLectureActionService;
use App\Http\Requests\LectureReservationCreateRequest;
use App\Http\Requests\LectureReservationUpdateRequest;
use App\Models\Lecture;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class LectureController extends Controller
{
    
    public function __construct(
        public readonly ReadLectureActionService $readLectureActionService,
        public readonly ReserveLectureActionService $reserveLectureActionService,
        public readonly DeleteLectureActionService $deleteLectureActionService,
        public readonly UpdateReserveLectureActionService $updateReserveLectureActionService
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
    public function editReservation(
        Lecture $lecture,
        LectureReservationUpdateRequest $lectureReservationUpdateRequest
        ): JsonResponse
    {
        return ($this->updateReserveLectureActionService)($lecture, $lectureReservationUpdateRequest->all());
    }
    
    // instructor delete reservation
    public function deleteReservation(Lecture $lecture): JsonResponse
    {
        return ($this->deleteLectureActionService)($lecture);
    }
    
    // user get reservations
    public function getReservation(Lecture $lecture): JsonResponse
    {
        return ($this->readLectureActionService)($lecture);
    }
    
    // user get reservations
    public function getUserReservations(User $user): JsonResponse
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
