<?php

namespace App\ActionService\Lecture;

use App\Action\Lecture\LectureGetAllAction;
use App\Action\Lecture\LectureGetAllInstructorAction;
use App\Action\Lecture\LectureGetAllStudentAction;
use App\Action\Lecture\LectureWithUserAction;
use App\ActionService\AbstractActionService;
use App\Models\Lecture;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class ReadLectureActionService extends AbstractActionService
{
    public function __construct(
        private readonly LectureGetAllAction $lectureGetAllAction,
        private readonly LectureGetAllStudentAction $lectureGetAllStudentAction,
        private readonly LectureWithUserAction $lectureWithUserAction,
        private readonly LectureGetAllInstructorAction $lectureGetAllInstructorAction
    ) {
        parent::__construct();
    }

    public function __invoke(?Lecture $lecture = null, ?User $user = null)
    {
        if (
            $lecture !== null
            && (!Auth::user()->isStudent()
                || ($this->lectureWithUserAction)($lecture, Auth::user())
            )
        ) {
            $lecture = ['lecture' => $lecture];
        } elseif (!Auth::user()->isStudent() && $user !== null) {
            $lecture = ['lectures' => ($this->lectureGetAllInstructorAction)($user)];
        } elseif (!Auth::user()->isStudent() && $user === null) {
            $lecture = ['lectures' => ($this->lectureGetAllAction)()];
        } elseif (Auth::user()->isStudent()) {
            $lecture = ['lectures' => ($this->lectureGetAllStudentAction)($user)];
        } else {
            throw new UnauthorizedException();
        }

        return ($this->responder)($lecture);
    }
}
