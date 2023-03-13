<?php

namespace App\Action\Lecture;

use App\Exceptions\ClassHasLectureException;
use App\Exceptions\ClassRoomIsOccupiedException;
use App\Exceptions\EndDateIsOlderThanStartDateException;
use App\Exceptions\InstructorHasLecturesException;
use App\Models\Lecture;
use Illuminate\Support\Carbon;

class LectureUpdateRemainingTimeAction
{
    public function __invoke(Lecture $lecture, string $newEnd): void
    {
        $end = $newEnd;
        $start = $lecture->start;
        $checkEnd = Carbon::createFromTimeString($end)->addMinute();
        $classId = $lecture->class_id;
        $classRoomId = $lecture->class_room_id;
        $instructorId = $lecture->instructor_id;

        if (Carbon::createFromTimeString($lecture->start)->greaterThan(Carbon::createFromTimeString($end))) {
            throw new EndDateIsOlderThanStartDateException();
        }

        $lectures = Lecture::query()
            ->where([
                ['class_id', '=', $classId],
                ['id', '!=', $lecture->id]
            ])
            ->whereDate('start', '<=', $checkEnd)
            ->whereTime('start', '<=', $checkEnd)
            ->whereDate('end', '=', $start)
            ->whereTime('end', '>', $start);

        if (
            $lectures->count() > 0
        ) {
            throw new ClassHasLectureException($lectures->get());
        }

        $lectures = Lecture::query()
            ->where([
                ['class_room_id', '=', $classRoomId],
                ['id', '!=', $lecture->id]
            ])
            ->whereDate('start', '<=', $checkEnd)
            ->whereTime('start', '<=', $checkEnd)
            ->whereDate('end', '=', $start)
            ->whereTime('end', '>', $start);

        if (
            $lectures->count() > 0
        ) {
            throw new ClassRoomIsOccupiedException($lectures->get());
        }

        $lectures = Lecture::query()
            ->where([
                ['instructor_id', '=', $instructorId],
                ['id', '!=', $lecture->id]
            ])
            ->whereDate('start', '<=', $checkEnd)
            ->whereTime('start', '<=', $checkEnd)
            ->whereDate('end', '=', $start)
            ->whereTime('end', '>', $start);
        if (
            $lectures->count() > 0
        ) {
            throw new InstructorHasLecturesException($lectures->get());
        }

        $lecture->end = $newEnd;
        $lecture->save();
    }
}
