<?php

namespace App\Action\Classroom;

use App\Models\ClassRoom;

class ClassroomCreateAction {
    public function __invoke(string $className, string $classDescription): ClassRoom
    {
        $classroom = new ClassRoom();
        $classroom->name = $className;
        $classroom->description = $classDescription;
        $classroom->save();
        return $classroom;
    }
}