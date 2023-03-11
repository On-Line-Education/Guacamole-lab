<?php

namespace App\Action\Lecture;

use App\Guacamole\Guacamole;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Models\Lecture;
use App\Models\StudentClasses;

class LectureStartAction
{
    public function __construct(
        private readonly Guacamole $guacamole
    ) {
    }

    public function __invoke(GuacamoleAuthLoginData $guacLogin, Lecture $lecture): void
    {
        $classRoom = $lecture->getClassRoom();
        $class = $lecture->getClass();

        $students = StudentClasses::where('student_class', $class->id)->get();
        foreach ($students as $student) {
            $username = $student->getStudent()->username;
            $group = $classRoom->name;
            $this->guacamole->getConnectionGroupEndpoint()->revokePermissions($guacLogin, $username, $group);
        }

        $this->guacamole->getConnectionGroupEndpoint()->revokePermissions(
            $guacLogin,
            $lecture->getInstructor()->username,
            $classRoom->name
        );

        $lecture->started = false;
        $lecture->save();
    }
}
