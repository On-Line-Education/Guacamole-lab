<?php

namespace App\Service;

use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Models\GuacUserData;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class GuacamoleUserLoginService
{
    public function __invoke()
    {
        $user = Auth::user();
        $guacData = GuacUserData::where('user_id', $user->id)->first();

        if (strtotime($guacData->expires) > strtotime(Carbon::now())) {
            $guacData->expires = Carbon::now()->addHour();
            $guacData->save();
            return new GuacamoleAuthLoginData([
                'authToken' => $guacData->token,
                'dataSource' => $guacData->data_source,
                'username' => $user->username
            ]);
        } else {
            Auth::user()->currentAccessToken()->delete();
            abort(Response::HTTP_UNAUTHORIZED, "Session expired");
        }


    }
}