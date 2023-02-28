<?php

namespace App\Action\StudentClass;

use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Collection;

class StudentClassGetAllAction
{
    public function __invoke(): Collection
    {
        return StudentClass::all();
    }
}
