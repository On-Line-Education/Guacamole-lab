<?php

namespace App\Action\Lecture;

use App\Guacamole\Guacamole;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Models\Computer;
use App\Models\Lecture;
use App\Models\StudentClasses;
use App\Models\User;

class LectureJoinAction
{
    public function __construct(
        private readonly Guacamole $guacamole
    ) {
    }

    public function __invoke(GuacamoleAuthLoginData $guacLogin, Lecture $lecture, User $user): void
    {
        $classRoom = $lecture->getClassRoom();
        $class = $lecture->getClass();

        $computer = null;
        $computers = [];
        if ($user->isStudent()){
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
            // dupa
        }

        $computer = array_shift($computers);
        $computer->user_id = $user->id;
        $computer->save();
        
        $username = $user->username;
        $group = $classRoom->name;
        $ip = $computer->ip;
        $domain = env('DOMAIN');
        $this->guacamole->getConnectionEndpoint()->create($guacLogin, $username, $group, $ip, $domain);
    }
}
