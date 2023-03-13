<?php

namespace App\Action\Classroom;

use App\Models\ClassRoom;

class ClassroomExistsAction
{

    public function __invoke(string $className): bool
    {
        return ClassRoom::where('name', $className)->count() > 0;
    }
}
