<?php

namespace App\Action\Classroom;

use App\Models\ClassRoom;
use App\Models\User;

class ClassroomGetAllWithInstructorsAction
{
    public function __invoke(): array
    {
        $users = User::all();
        $usersWithClassRooms = [];
        foreach ($users as $user) {
            if (!$user->assigned_class_room) {
                continue;
            }
            $usersWithClassRooms[] = ['user' => $user, 'classRoom' => ClassRoom::find($user->assigned_class_room)];
        }
        return $usersWithClassRooms;
    }
}
