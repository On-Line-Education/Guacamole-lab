<?php

namespace App\Action\Lecture;

use App\Models\Lecture;
use App\Models\StudentClasses;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class LectureGetAllStudentAction
{
    public function __invoke(User $user): Collection
    {
        $studentClasses = StudentClasses::where('student', $user->id)->get();
        $where = [];
        foreach ($studentClasses as $student) {
           $where[] = ['class_id', '=', $student->student_class];
        }
        return Lecture::where($where)->get();
    }
}
