<?php

namespace App\Action\StudentClass;

use App\Action\Login\GuacamoleAuthLoginAction;
use App\Action\User\UserGetByUsernameAction;
use App\Models\StudentClass;
use App\Models\StudentClasses;
use App\Models\User;

class StudentClassGetAllUsersAction
{
    public function __construct(
        private readonly UserGetByUsernameAction $userGetByUsernameAction,
        private readonly GuacamoleAuthLoginAction $guacamoleAuthLoginAction
    ) {
    }
    
    public function __invoke(StudentClass $studentClass): array
    {
        $guacAuth = ($this->guacamoleAuthLoginAction)(env('GUACAMOLE_ADMIN'), env('GUACAMOLE_ADMIN_PASSWORD'));
        $students = [];
        $studentClasses = StudentClasses::where('student_class', $studentClass->id)->get();
        foreach ($studentClasses as $student) {
            $students[] = ($this->userGetByUsernameAction)($guacAuth, $student->getStudent()->username);
        }
        foreach ($students as &$guacUser) {
            $usr = User::where('username', $guacUser->username)->first();
            $guacUser->id = $usr?->id ?? null;
            $usrGroups = $usr?->getGroups() ?? [];
            $guacUser = $usr?->getUserWithGuacDataArray($guacUser) ?? $guacUser->getGuacFormat();
            $guacUser = array_merge(
                ['classes' => $usrGroups],
                $guacUser
            );
            unset($guacUser['password']);
        }
        return $students;
    }
}
