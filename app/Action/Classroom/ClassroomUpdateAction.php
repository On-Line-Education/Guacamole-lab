<?php

namespace App\Action\Classroom;

use App\Models\ClassRoom;

class ClassroomUpdateAction {
    public function __invoke(int $id, ?string $newName = null, ?string $newDescription = null)
    {
        $classRoom = ClassRoom::find($id);
        $classRoom->name = $newName ?? $classRoom->name;
        $classRoom->description = $newDescription ?? $classRoom->description;
        $classRoom->save();
        return $classRoom;
    }
}