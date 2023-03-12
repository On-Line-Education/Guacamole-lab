<?php

namespace App\Http\Controllers;

use App\ActionService\Lecture\DeleteLectureActionService;
use App\ActionService\Lecture\GetRemainingTimeLectureActionService;
use App\ActionService\Lecture\JoinLectureActionService;
use App\ActionService\Lecture\ReadLectureActionService;
use App\ActionService\Lecture\ReserveLectureActionService;
use App\ActionService\Lecture\UpdateRemainingTimeLectureActionService;
use App\ActionService\Lecture\UpdateReserveLectureActionService;
use App\Http\Requests\LectureReservationCreateRequest;
use App\Http\Requests\LectureReservationUpdateRequest;
use App\Http\Requests\LectureTimeUpdateRequest;
use App\Models\Lecture;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class LectureController extends Controller
{
    
    public function __construct(
        private readonly ReadLectureActionService $readLectureActionService,
        private readonly ReserveLectureActionService $reserveLectureActionService,
        private readonly DeleteLectureActionService $deleteLectureActionService,
        private readonly UpdateReserveLectureActionService $updateReserveLectureActionService,
        private readonly UpdateRemainingTimeLectureActionService $updateRemainingTimeLectureActionService,
        private readonly GetRemainingTimeLectureActionService $getRemainingTimeLectureActionService,
        private readonly JoinLectureActionService $joinLectureActionService
    ) {
    }

    // student join lectore
    public function join(Lecture $lecture): JsonResponse
    {
        return ($this->joinLectureActionService)($lecture);
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
    
    // instructor get all
    public function getAll(): JsonResponse
    {
        return ($this->readLectureActionService)();
    }

    // get remaining time
    public function getRemainingTime(Lecture $lecture): JsonResponse
    {
        return ($this->getRemainingTimeLectureActionService)($lecture);
    }

    // update time
    public function updateTime(Lecture $lecture, LectureTimeUpdateRequest $lectureTimeUpdateRequest): JsonResponse
    {
        return ($this->updateRemainingTimeLectureActionService)($lecture, $lectureTimeUpdateRequest->all());
    }
}
