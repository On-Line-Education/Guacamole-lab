<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuacUserData extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'data_source',
        'expires',
        'user_id'
    ];
}
