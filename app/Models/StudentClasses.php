<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClasses extends Model
{
    use HasFactory;
    protected $table = 'student_in_classes';

    public function getStudent(): User
    {
        return User::find($this->student);
    }

    public function getClass(): StudentClass
    {
        return StudentClass::find($this->student_class);
    }
}
