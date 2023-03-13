<?php

namespace App\ActionService\Lecture;

use App\Action\Lecture\LectureReserveUpdateAction;
use App\ActionService\AbstractActionService;
use App\Models\Lecture;
use App\Service\GuacamoleUserLoginService;

class UpdateReserveLectureActionService extends AbstractActionService
{
    public function __construct(
        private readonly LectureReserveUpdateAction $lectureReserveUpdateAction,
    ) {
        parent::__construct();
    }

    public function __invoke(Lecture $lecture, array $lectureData)
    {
        (new GuacamoleUserLoginService())();
        $lecture = ($this->lectureReserveUpdateAction)($lecture, $lectureData);
        return ($this->responder)(['lecture' => $lecture]);
    }
}
