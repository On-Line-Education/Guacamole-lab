<?php

namespace App\Action\StudentClass;

use App\Models\StudentClass;

class StudentClassUpdateAction {
    public function __invoke(int $id, ?string $newName = null)
    {
        $class = StudentClass::find($id);

        if ($class === $newName) {
            return $class;
        }

        $class->name = $newName ?? $class->name;
        $class->save();
        return $class;
    }
}
