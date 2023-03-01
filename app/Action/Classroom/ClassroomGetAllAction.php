<?php

namespace App\Action\Classroom;

use App\Models\ClassRoom;
use Illuminate\Database\Eloquent\Collection;

class ClassroomGetAllAction
{
    public function __invoke(): Collection
    {
        return ClassRoom::all();
    }
}
