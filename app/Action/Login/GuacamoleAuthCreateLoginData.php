<?php

namespace App\Action\Login;

use App\Models\GuacUserData;
use Illuminate\Support\Carbon;

class GuacamoleAuthCreateLoginData
{
    public function __invoke(int $userId, string $guacAuthToken, string $guacDataSource)
    {
        GuacUserData::where('user_id', $userId)->delete();
        GuacUserData::create([
                'token' => $guacAuthToken,
                'user_id' => $userId,
                'data_source' => $guacDataSource,
                'expires' => Carbon::now(env('TIMEZONE', null))->addHour()
            ]);
    }
}
