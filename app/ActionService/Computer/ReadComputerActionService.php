<?php

namespace App\ActionService\Computer;

use App\Action\Computer\ComputerGetAllAction;
use App\Action\Computer\ComputerGetAllInClassAction;
use App\Action\Computer\ComputerGetAllUsersAction;
use App\ActionService\AbstractActionService;
use App\Models\ClassRoom;
use App\Models\Computer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReadComputerActionService extends AbstractActionService
{
    public function __construct(
        private readonly ComputerGetAllAction $computerGetAllAction,
        private readonly ComputerGetAllInClassAction $computerGetAllInClassAction,
        private readonly ComputerGetAllUsersAction $computerGetAllUsersAction
    ) {
        parent::__construct();
    }

    public function __invoke(?ClassRoom $classRoom = null, ?Computer $computer = null, ?User $user = null)
    {
        if ($user !== null) {
            $computers = ($this->computerGetAllUsersAction)($user);
        }
        elseif (!is_null($computer) && !is_null($classRoom)) {
            if ($classRoom->id !== $computer->class_room_id) {
                throw new NotFoundHttpException();
            }
            $computers = ['computer' => $computer];
        } elseif (!is_null($classRoom) && !Auth::user()->isStudent()) {
            $computers = ['computers' => ($this->computerGetAllInClassAction)($classRoom)];
        } elseif (is_null($computer) && is_null($classRoom) && !Auth::user()->isStudent()) {
            $computers = ['computers' => ($this->computerGetAllAction)()];
        } elseif (Auth::user()->isStudent()) {
            throw new UnauthorizedException();
        } else {
            $computers = [];
        }

        return ($this->responder)($computers);
    }
}
