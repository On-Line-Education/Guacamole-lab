<?php

use App\Models\User;
use App\System\SystemPermissions;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('make:test:admin', function () {
    $user = new User();
    $user->username = "guacadmin";
    $user->password = Hash::make("guacadmin");
    $user->role = SystemPermissions::ADMIN;
    $user->save();
    $this->comment("Login: guacadmin  Password: guacadmin");
})->purpose("Creates test admin");