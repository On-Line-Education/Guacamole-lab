<?php

namespace App\ActionService\Classroom;

use App\Action\Classroom\ClassroomAssignAction;
use App\Action\Classroom\ClassroomUnassignAction;
use App\ActionService\AbstractActionService;
use App\Exceptions\ClassroomAlreadyAssignedException;
use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class InstructorClassroomAssignActionService extends AbstractActionService
{
    public function __construct(
        private readonly ClassroomAssignAction $classroomAssignAction,
        private readonly ClassroomUnassignAction $classroomUnassignAction
    ) {
        parent::__construct();
    }

    public function __invoke(bool $assign, array $assignData)
    {
        $currUser = Auth::user();
        if ($currUser->isAdmin()) {
            $currUser = User::find($assignData['userId']);
        }
        match ($assign) {
            true => $this->assign($currUser, $assignData),
            false => $this->unassign($currUser)
        };
        
        return ($this->responder)();
    }

    private function assign(User $user, array $assignData)
    {
        $classroomId = $assignData['classroomId'];
        $force = $assignData['force'] ?? false;
        if (User::where([
            ['assigned_class_room', '=', $classroomId],
            ['role', '=', 'instructor']
            ])->count() > 0 && !$force) {
            throw new ClassroomAlreadyAssignedException();
        }
        ($this->classroomAssignAction)(ClassRoom::find($classroomId), $user);
    }

    private function unassign(User $user)
    {
        ($this->classroomUnassignAction)($user);
    }
}
