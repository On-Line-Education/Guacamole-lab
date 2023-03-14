<?php

namespace App\Action\Lecture;

use App\Action\Login\GuacamoleAuthLoginAction;
use App\Guacamole\Guacamole;
use App\Models\Lecture;
use Illuminate\Support\Carbon;

class LectureStartLecturesAction
{
    public function __construct(
        private readonly Guacamole $guacamole,
        private readonly GuacamoleAuthLoginAction $guacamoleAuthLoginAction,
        private readonly LectureStartAction $lectureStartAction
    ) {
    }

    public function __invoke(): void
    {
        $now = Carbon::now(env('TIMEZONE', null));
        $guacLogin = ($this->guacamoleAuthLoginAction)(env('GUACAMOLE_ADMIN'), env('GUACAMOLE_ADMIN_PASSWORD'));
        $lectures = Lecture::query()
            ->whereDate('start', '<=', $now)
            ->whereTime('start', '<=', $now)
            ->whereDate('end', '>=', $now)
            ->whereTime('end', '>', $now)
            ->get();
        foreach ($lectures as $lecture) {
            if (!$lecture->started) {
                ($this->lectureStartAction)($guacLogin, $lecture);
            }
        }
    }
}