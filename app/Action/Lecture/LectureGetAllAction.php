<?php

namespace App\Action\Lecture;

use App\Models\Lecture;
use Illuminate\Database\Eloquent\Collection;

class LectureGetAllAction
{
    public function __invoke(): Collection
    {
        return Lecture::all();
    }
}
