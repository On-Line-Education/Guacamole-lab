<?php

namespace App\ActionService\Lecture;

use App\Action\Lecture\LectureJoinAction;
use App\ActionService\AbstractActionService;
use App\Models\Lecture;
use App\Service\GuacamoleUserLoginService;
use Illuminate\Support\Facades\Auth;

class JoinLectureActionService extends AbstractActionService
{
    public function __construct(
        private readonly LectureJoinAction $lectureJoinAction,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService
    ) {
        parent::__construct();
    }

    public function __invoke(Lecture $lecture)
    {
        $user = Auth::user();
        $guacAuth = ($this->guacamoleUserLoginService)($user);
        $lecture = ($this->lectureJoinAction)($guacAuth, $lecture, $user);
        return ($this->responder)(['lecture' => $lecture]);
    }
}
