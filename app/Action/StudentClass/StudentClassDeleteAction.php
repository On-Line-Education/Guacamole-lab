<?php

namespace App\Action\StudentClass;

use App\Models\StudentClass;

class StudentClassDeleteAction {
    public function __invoke(int $id): void
    {
        StudentClass::find($id)->delete();
    }
}
