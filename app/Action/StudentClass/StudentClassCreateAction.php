<?php

namespace App\Action\StudentClass;

use App\Exceptions\ClassAlreadyExistsException;
use App\Models\StudentClass;

class StudentClassCreateAction
{
    public function __invoke(string $className): StudentClass
    {
        if (StudentClass::where('name', $className)->count() > 0) {
            throw new ClassAlreadyExistsException();
        }
        $class = new StudentClass();
        $class->name = $className;
        $class->save();
        return $class;
    }
}
