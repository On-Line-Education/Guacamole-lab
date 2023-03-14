<?php

namespace App\Action\Lecture;

use App\Models\ClassRoom;
use App\Models\Lecture;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class LectureGetAllInstructorAction
{
    public function __invoke(User $user): Collection
    {
        $lectures = Lecture::where('instructor_id', $user->id)->get();

        foreach ($lectures as &$lecture) {
            $lecture->instructor = $user;
            $lecture->class_room = ClassRoom::find($lecture->class_room_id);
            $lecture->class = StudentClass::find($lecture->class_id);
             
            unset($lecture->instructor_id);
            unset($lecture->class_room_id);
            unset($lecture->class_id);
        }
        return $lectures;
    }
}
