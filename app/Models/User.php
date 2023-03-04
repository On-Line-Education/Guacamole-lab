<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Guacamole\Objects\User\GuacamoleUserData;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function isInstructor(): bool
    {
        return $this->role === 'instructor';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function attachToClassroom(int $classroomId): User
    {
        if (ClassRoom::find($classroomId) === null) {
            throw new Exception('ClassRoom object doesn\'t exist', 500);
        }
        $this->assigned_class_room = $classroomId;
        $this->save();
        return $this;
    }

    public function detachFromClassroom(): User
    {
        $this->assigned_class_room = null;
        $this->save();
        return $this;
    }

    public function getUserWithGuacDataArray(GuacamoleUserData $guacUser): array
    {
        $guacUser->id = $this->id;
        $userData = (array)$guacUser;
        $userData['role'] = $this->role;
        $userData['assigned_class_room'] = $this->assigned_class_room;
        unset($userData['password']);
        return $userData;
    }
}
