<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    public function getClassRoom(): ClassRoom
    {
        return ClassRoom::find($this->class_room_id);
    }

    public function getClass(): StudentClass
    {
        return StudentClass::find($this->class_id);
    }

    public function getInstructor(): User
    {
        return User::find($this->instructor_id);
    }
}
