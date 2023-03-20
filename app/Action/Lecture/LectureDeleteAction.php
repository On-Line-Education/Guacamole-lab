<?php

namespace App\Action\Lecture;

use App\Action\Login\GuacamoleAuthLoginAction;
use App\Guacamole\Guacamole;
use App\Models\Lecture;
use Carbon\Carbon;

class LectureDeleteAction
{
    public function __construct(
        private readonly LectureEndAction $lectureEndAction,
        private readonly GuacamoleAuthLoginAction $guacamoleAuthLoginAction,
        private readonly Guacamole $guacamole
    ) {
    }

    public function __invoke(Lecture $lecture): void
    {
        if ($lecture->started) {
            $lecture->end = Carbon::now(env('TIMEZONE', null));
            $lecture->save();
            $lecture->started = false;
            $guacLogin = ($this->guacamoleAuthLoginAction)(env('GUACAMOLE_ADMIN'), env('GUACAMOLE_ADMIN_PASSWORD'));
            ($this->lectureEndAction)($lecture);
            $this->guacamole->getAuth()->logout($guacLogin->getAuthToken());
        }
        $lecture->delete();
    }
}
