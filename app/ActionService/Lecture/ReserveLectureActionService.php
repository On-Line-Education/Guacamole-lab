<?php

namespace App\ActionService\Lecture;

use App\Action\Lecture\LectureReserveAction;
use App\ActionService\AbstractActionService;

class ReserveLectureActionService extends AbstractActionService
{
    public function __construct(
        private readonly LectureReserveAction $lectureReserveAction,
    ) {
        parent::__construct();
    }

    public function __invoke(array $lectureData)
    {
        $lecture = ($this->lectureReserveAction)($lectureData);
        return ($this->responder)(['lecture' => $lecture]);
    }
}
