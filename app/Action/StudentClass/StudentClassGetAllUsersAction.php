<?php

namespace App\Action\StudentClass;

use App\Models\StudentClass;
use App\Models\StudentClasses;
use Illuminate\Database\Eloquent\Collection;

class StudentClassGetAllUsersAction
{
    public function __invoke(StudentClass $studentClass): array
    {
        $students = [];
        $studentClasses = StudentClasses::where('student_class', $studentClass->id)->get();
        foreach ($studentClasses as $student) {
            $students[] = $student->getStudent();
        }
        return $students;
    }
}
