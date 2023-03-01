<?php

namespace App\Action\Classroom;

use App\Models\ClassRoom;

class ClassroomDeleteAction
{
    public function __invoke(int $id): void
    {
        ClassRoom::find($id)->delete();
    }
}
