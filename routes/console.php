<?php

use App\Models\GuacUserData;
use App\Models\Lecture;
use App\Models\User;
use App\System\SystemPermissions;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Carbon;
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
    $user->username = 'guacadmin';
    $user->password = Hash::make('guacadmin');
    $user->role = SystemPermissions::ADMIN;
    $user->save();
    $this->comment('Login: guacadmin  Password: guacadmin');
})->purpose('Creates test admin');

Artisan::command('make:admin {username} {password}', function ($username, $password) {
    $user = new User();
    $user->username = $username;
    $user->password = Hash::make($password);
    $user->role = SystemPermissions::ADMIN;
    $user->save();
    $this->comment('Login: ' . $username . '  Password: ' . $password);
})->purpose('Creates admin');

Artisan::command('change:user:password {username} {password}', function ($username, $password) {
    $user = User::where('username', $username)->first();
    $user->password = Hash::make($password);
    $user->save();
    $this->comment('Password changed');
})->purpose('Changes user password');

Artisan::command('check:clean', function () {
    $now = Carbon::now(env('TIMEZONE', null));
    $guacData = GuacUserData::where('expires', '<', $now)->get();
    foreach ($guacData as $data) {
        $data->delete();
    }
    Lecture::query()
        ->whereDate('end', '<', $now->addDays(7))
        ->delete();
})->purpose('Clears expired tokens etc');
