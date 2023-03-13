<?php

namespace App\Action\Lecture;

use App\Models\Lecture;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class LectureGetAllInstructorAction
{
    public function __invoke(User $user): Collection
    {
        return Lecture::where('instructor_id', $user->id)->get();
    }
}
