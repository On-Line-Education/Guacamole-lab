<?php

namespace App\Action\Lecture;

use App\Exceptions\InvalidStudentClassException;
use App\Exceptions\LectureNotStartedException;
use App\Exceptions\NoComputerLeftException;
use App\Guacamole\Guacamole;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Models\Computer;
use App\Models\Connection;
use App\Models\Lecture;
use App\Models\StudentClasses;
use App\Models\User;

class LectureJoinAction
{
    public function __construct(
        private readonly Guacamole $guacamole
    ) {
    }

    public function __invoke(GuacamoleAuthLoginData $guacLogin, Lecture $lecture, User $user): string
    {
        if (!$lecture->started) {
            throw new LectureNotStartedException();
        }

        $connection = Connection::where('user_id', $user->id);
        if ($connection->count() > 0) {
            return Guacamole::generateSessionConnectionUrl(
                $connection->first()->connection,
                $guacLogin->dataSource
            );
        }

        $classRoom = $lecture->getClassRoom();

        if (StudentClasses::where([
            ['student', '=', $user->id],
            ['student_class', '=', $lecture->getClass()->id]
        ])->count() === 0) {
            throw new InvalidStudentClassException();
        }

        $computer = null;
        $computers = [];
        if ($user->isStudent()) {
            $computers = Computer::where([
                ['class_room_id', '=', $classRoom->id],
                ['instructor', '=', false],
                ['user_id', '=', null]
            ])->get();
        } else {
            $computers = Computer::where([
                ['class_room_id', '=', $classRoom->id],
                ['instructor', '=', true],
                ['user_id', '=', null]
            ])->get();
        }
        if (count($computers) === 0) {
            throw new NoComputerLeftException();
        }

        $computer = $computers->first();
        $computer->user_id = $user->id;
        $computer->save();

        $username = $user->username;
        $group = $classRoom->name;
        $ip = $computer->ip;
        $domain = env('DOMAIN', '');
        $guacConnection = $this->guacamole->getConnectionEndpoint()->create(
            $guacLogin,
            $username,
            $group,
            $ip,
            $domain
        );
        $connection = new Connection();
        $connection->user_id = $user->id;
        $connection->connection = $guacConnection->identifier;
        $connection->save();
        return Guacamole::generateSessionConnectionUrl(
            $guacConnection->identifier,
            $guacLogin->dataSource
        );
    }
}
