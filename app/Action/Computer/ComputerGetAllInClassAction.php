<?php

namespace App\Action\Computer;

use App\Models\ClassRoom;
use App\Models\Computer;
use Illuminate\Database\Eloquent\Collection;

class ComputerGetAllInClassAction
{
    public function __invoke(ClassRoom $classRoom): Collection
    {
        return $classRoom->computers()->get();
    }
}