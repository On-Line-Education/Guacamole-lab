<?php

namespace App\ActionService\Lecture;

use App\Action\Lecture\LectureGetRemainingTimeAction;
use App\ActionService\AbstractActionService;
use App\Models\Lecture;
use App\Service\GuacamoleUserLoginService;

class GetRemainingTimeLectureActionService extends AbstractActionService
{
    public function __construct(
        private readonly LectureGetRemainingTimeAction $lectureGetRemainingTimeAction,
    ) {
        parent::__construct();
    }

    public function __invoke(Lecture $lecture)
    {
        (new GuacamoleUserLoginService())();
        $time = ($this->lectureGetRemainingTimeAction)($lecture);
        return ($this->responder)(['time' => $time]);
    }
}
