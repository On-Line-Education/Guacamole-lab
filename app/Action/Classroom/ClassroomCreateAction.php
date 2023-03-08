<?php

namespace App\Action\Classroom;

use App\Exceptions\ClassroomAlreadyExistsException;
use App\Models\ClassRoom;

class ClassroomCreateAction
{
    public function __invoke(string $className, string $classDescription): ClassRoom
    {
        if (ClassRoom::where('name', $className)->count() > 0) {
            throw new ClassroomAlreadyExistsException();
        }
        $classroom = new ClassRoom();
        $classroom->name = $className;
        $classroom->description = $classDescription;
        $classroom->save();
        return $classroom;
    }
}
