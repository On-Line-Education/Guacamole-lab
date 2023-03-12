<?php

namespace App\ActionService\Lecture;

use App\Action\Lecture\LectureUpdateRemainingTimeAction;
use App\ActionService\AbstractActionService;
use App\Models\Lecture;
use App\Service\GuacamoleUserLoginService;

class UpdateRemainingTimeLectureActionService extends AbstractActionService
{
    public function __construct(
        private readonly LectureUpdateRemainingTimeAction $lectureUpdateRemainingTimeAction,
    ) {
        parent::__construct();
    }

    public function __invoke(Lecture $lecture, array $lectureData)
    {
        (new GuacamoleUserLoginService())();
        ($this->lectureUpdateRemainingTimeAction)($lecture, $lectureData['end']);
        return ($this->responder)();
    }
}
