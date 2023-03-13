<?php

namespace App\Action\Lecture;

use App\Models\Lecture;

class LectureDeleteAction
{
    public function __invoke(Lecture $lecture): void
    {
        $lecture->delete();
    }
}
