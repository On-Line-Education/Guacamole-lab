<?php

namespace App\Action\Classroom;

use App\Models\ClassRoom;
use App\Models\Computer;
use App\Models\Lecture;

class ClassroomDeleteAction
{
    public function __invoke(int $id): void
    {
        Computer::where('class_room_id', $id)->delete();
        Lecture::where('class_room_id', $id)->delete();
        ClassRoom::find($id)->delete();
    }
}
