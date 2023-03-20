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
            $this->end($guacLogin, $student->getStudent()->id, $username, $group);
        }

        $this->end($guacLogin, $lecture->getInstructor()->id, $lecture->getInstructor()->username, $classRoom->name);

        $lecture->started = false;
        $lecture->save();
    }

    public function end($guacLogin, int $id, string $username, string $group) {
        try {
            $connection = Connection::where('user_id', $id)->first();
            $this->guacamole->getConnectionEndpoint()->revokePermission(
                $guacLogin,
                $username,
                $connection->connection
            );
            $this->guacamole->getConnectionGroupEndpoint()->revokePermissions(
                $guacLogin,
                $username,
                $group
            );
            $this->guacamole->getConnectionEndpoint()->killConnection(
                $guacLogin,
                $connection->connection
            );
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        try {
            $computer = Computer::where('user_id', $id)->first();
            if ($computer !== null) {
                $computer->user_id = null;
                $computer->save();
            }
            Connection::where('user_id', $id)->delete();
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }
}
