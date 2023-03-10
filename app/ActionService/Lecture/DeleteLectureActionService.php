<?php

namespace App\ActionService\Lecture;

use App\Action\Lecture\LectureDeleteAction;
use App\ActionService\AbstractActionService;
use App\Models\Lecture;

class DeleteLectureActionService extends AbstractActionService
{
    public function __construct(
        private readonly LectureDeleteAction $lectureDeleteAction,
    ) {
        parent::__construct();
    }

    public function __invoke(Lecture $lecture)
    {
        $lecture = ($this->lectureDeleteAction)($lecture);
        return ($this->responder)();
    }
}
