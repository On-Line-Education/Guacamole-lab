<?php

namespace App\Action\StudentClass;

use App\Models\StudentClass;

class StudentClassCreateAction
{
    public function __invoke(string $className): StudentClass
    {
        $class = new StudentClass();
        $class->name = $className;
        $class->save();
        return $class;
    }
}
