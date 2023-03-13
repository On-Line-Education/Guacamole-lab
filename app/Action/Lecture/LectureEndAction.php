<?php

namespace App\Action\Lecture;

use App\Guacamole\Guacamole;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Models\Computer;
use App\Models\Connection;
use App\Models\Lecture;
use App\Models\StudentClasses;

class LectureEndAction
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
            $computer = Computer::where('user_id', $student->id)->first();
            if ($computer !== null) {
                $computer->user_id = null;
                $computer->save();
            }
            Connection::where('user_id', $student->getStudent()->id)->delete();
        }

        $this->guacamole->getConnectionGroupEndpoint()->revokePermissions(
            $guacLogin,
            $lecture->getInstructor()->username,
            $classRoom->name
        );
        $computer = Computer::where('user_id', $lecture->getInstructor()->id)->first();
        if ($computer !== null) {
            $computer->user_id = null;
            $computer->save();
        }
        Connection::where('user_id', $lecture->getInstructor()->id)->delete();

        $lecture->started = false;
        $lecture->save();
    }
}
