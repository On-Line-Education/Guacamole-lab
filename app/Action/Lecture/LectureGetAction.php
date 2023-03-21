<?php

namespace App\Action\Lecture;

use App\Models\ClassRoom;
use App\Models\Lecture;
use App\Models\StudentClass;
use App\Models\User;

class LectureGetAction
{
    public function __invoke(Lecture $lecture): Lecture
    {
        $lecture->instructor = User::find($lecture->instructor_id);
        $lecture->class_room = ClassRoom::find($lecture->class_room_id);
        $lecture->class = StudentClass::find($lecture->class_id);

        unset($lecture->instructor_id);
        unset($lecture->class_room_id);
        unset($lecture->class_id);
        return $lecture;
    }
}
