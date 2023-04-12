<?php

namespace App\Action\Lecture;

use App\Exceptions\CannotReserveLectureInThePastException;
use App\Exceptions\ClassHasLectureException;
use App\Exceptions\ClassRoomIsOccupiedException;
use App\Exceptions\EndDateIsOlderThanStartDateException;
use App\Exceptions\InstructorHasLecturesException;
use App\Models\Lecture;
use Illuminate\Support\Carbon;

class LectureReserveAction
{
    public function __invoke(array $reserveData): Lecture
    {

        $start = $reserveData['start'];
        $end = $reserveData['end'];
        $checkStart = Carbon::createFromTimeString($start)->subMinutes(3);
        $checkEnd = Carbon::createFromTimeString($end)->subMinutes(3);
        $classId = $reserveData['class_id'];
        $classRoomId = $reserveData['class_room_id'];
        $instructorId = $reserveData['instructor_id'];
        $name = $reserveData['name'];


        if (Carbon::now(env('TIMEZONE', null))->greaterThan($end)) {
            throw new CannotReserveLectureInThePastException();
        }

        if (Carbon::createFromTimeString($start)->greaterThan(Carbon::createFromTimeString($end))) {
            throw new EndDateIsOlderThanStartDateException();
        }

        $lectures = Lecture::query()
            ->orWhere(function ($query) use ($classId, $checkStart) {
                $query->where('class_id', $classId)
                    ->whereDate('start', '<=', $checkStart)
                    ->whereTime('start', '<', $checkStart)
                    ->whereDate('end', '>=', $checkStart)
                    ->whereTime('end', '>', $checkStart);
            })
            ->orWhere(function ($query) use ($classId, $checkEnd) {
                $query->where('class_id', $classId)
                    ->whereDate('start', '<=', $checkEnd)
                    ->whereTime('start', '<', $checkEnd)
                    ->whereDate('end', '>=', $checkEnd)
                    ->whereTime('end', '>', $checkEnd);
            })
            ->orWhere(function ($query) use ($classId, $checkEnd, $checkStart) {
                $query->where('class_id', $classId)
                    ->whereDate('start', '>=', $checkStart)
                    ->whereTime('start', '>', $checkStart)
                    ->whereDate('end', '<=', $checkEnd)
                    ->whereTime('end', '<', $checkEnd);
            });
        if (
            $lectures->count() > 0
        ) {
            throw new ClassHasLectureException($lectures->get());
        }

        $lectures = Lecture::query()
            ->orWhere(function ($query) use ($classRoomId, $checkStart) {
                $query->where('class_room_id', $classRoomId)
                    ->whereDate('start', '<=', $checkStart)
                    ->whereTime('start', '<', $checkStart)
                    ->whereDate('end', '>=', $checkStart)
                    ->whereTime('end', '>', $checkStart);
            })
            ->orWhere(function ($query) use ($classRoomId, $checkEnd) {
                $query->where('class_room_id', $classRoomId)
                    ->whereDate('start', '<=', $checkEnd)
                    ->whereTime('start', '<', $checkEnd)
                    ->whereDate('end', '>=', $checkEnd)
                    ->whereTime('end', '>', $checkEnd);
            })
            ->orWhere(function ($query) use ($classRoomId, $checkEnd, $checkStart) {
                $query->where('class_room_id', $classRoomId)
                    ->whereDate('start', '>=', $checkStart)
                    ->whereTime('start', '>', $checkStart)
                    ->whereDate('end', '<=', $checkEnd)
                    ->whereTime('end', '<', $checkEnd);
            });

        if (
            $lectures->count() > 0
        ) {
            throw new ClassRoomIsOccupiedException($lectures->get());
        }

        $lectures = Lecture::query()
            ->orWhere(function ($query) use ($instructorId, $checkStart) {
                $query->where('instructor_id', $instructorId)
                    ->whereDate('start', '<=', $checkStart)
                    ->whereTime('start', '<', $checkStart)
                    ->whereDate('end', '>=', $checkStart)
                    ->whereTime('end', '>', $checkStart);
            })
            ->orWhere(function ($query) use ($instructorId, $checkEnd) {
                $query->where('instructor_id', $instructorId)
                    ->whereDate('start', '<=', $checkEnd)
                    ->whereTime('start', '<', $checkEnd)
                    ->whereDate('end', '>=', $checkEnd)
                    ->whereTime('end', '>', $checkEnd);
            })
            ->orWhere(function ($query) use ($instructorId, $checkEnd, $checkStart) {
                $query->where('instructor_id', $instructorId)
                    ->whereDate('start', '>=', $checkStart)
                    ->whereTime('start', '>', $checkStart)
                    ->whereDate('end', '<=', $checkEnd)
                    ->whereTime('end', '<', $checkEnd);
            });

        if (
            $lectures->count() > 0
        ) {
            throw new InstructorHasLecturesException($lectures->get());
        }

        $lecture = new Lecture();
        $lecture->start = $start;
        $lecture->end = $end;
        $lecture->class_id = $classId;
        $lecture->class_room_id = $classRoomId;
        $lecture->instructor_id = $instructorId;
        $lecture->name = $name;
        $lecture->save();

        return $lecture;
    }
}
