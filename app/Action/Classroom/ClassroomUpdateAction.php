<?php

namespace App\Action\Classroom;

use App\Action\Login\GuacamoleAuthLoginAction;
use App\Guacamole\Guacamole;
use App\Models\ClassRoom;

class ClassroomUpdateAction
{
    public function __construct(
        private readonly GuacamoleAuthLoginAction $guacamoleAuthLoginAction,
        private readonly Guacamole $guacamole
    ) {
    }

    public function __invoke(int $id, ?string $newName = null, ?string $newDescription = null)
    {
        $classRoom = ClassRoom::find($id);
        if ($newName) {
            $guacAuth = ($this->guacamoleAuthLoginAction)(env('GUACAMOLE_ADMIN'), env('GUACAMOLE_ADMIN_PASSWORD'));
            $this->guacamole->getConnectionGroupEndpoint()->update($guacAuth, $classRoom->name, $newName);
        }
        
        $classRoom->name = $newName ?? $classRoom->name;
        $classRoom->description = $newDescription ?? $classRoom->description;
        $classRoom->save();
        return $classRoom;
    }
}
