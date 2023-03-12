<?php

namespace App\Action\Lecture;

use App\Models\Lecture;
use Illuminate\Support\Carbon;

class LectureGetRemainingTimeAction
{
    public function __invoke(Lecture $lecture): string
    {
        return gmdate(
            'H:i:s',
            Carbon::parse($lecture->end, env('TIMEZONE', null))
                ->diffInSeconds(Carbon::now(env('TIMEZONE', null)))
        );
    }
}
