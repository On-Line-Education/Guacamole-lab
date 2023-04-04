<?php

namespace App\Action\Lecture;

use App\Exceptions\ClassHasLectureException;
use App\Exceptions\ClassRoomIsOccupiedException;
use App\Exceptions\EndDateIsOlderThanStartDateException;
use App\Exceptions\InstructorHasLecturesException;
use App\Models\Lecture;
use Illuminate\Support\Carbon;

class LectureReserveUpdateAction
{
    public function __invoke(Lecture $lecture, array $reserveData): Lecture
    {
        $start = $reserveData['start'] ?? $lecture->start;
        $end = $reserveData['end'] ?? $lecture->end;
        $checkStart = Carbon::createFromTimeString($start)->subMinutes(3);
        $checkEnd = Carbon::createFromTimeString($end)->subMinutes(3);
        $classId = $reserveData['class_id'] ?? $lecture->class_id;
        $classRoomId = $reserveData['class_room_id'] ?? $lecture->class_room_id;
        $instructorId = $lecture->instructor_id;
        $name = $reserveData['name'] ?? $lecture->name;

        if (Carbon::createFromTimeString($start)->greaterThan(Carbon::createFromTimeString($end))) {
            throw new EndDateIsOlderThanStartDateException();
        }

        $lectures = Lecture::query()
            ->orWhere(function ($query) use ($classId, $checkStart, $lecture) {
                $query->where('class_id', $classId)
                    ->where('id', '!=', $lecture->id)
                    ->whereDate('start', '<=', $checkStart)
                    ->whereTime('start', '<', $checkStart)
                    ->whereDate('end', '>=', $checkStart)
                    ->whereTime('end', '>', $checkStart);
            })
            ->orWhere(function ($query) use ($classId, $checkEnd, $lecture) {
                $query->where('class_id', $classId)
                    ->where('id', '!=', $lecture->id)
                    ->whereDate('start', '<=', $checkEnd)
                    ->whereTime('start', '<', $checkEnd)
                    ->whereDate('end', '>=', $checkEnd)
                    ->whereTime('end', '>', $checkEnd);
            })
            ->orWhere(function ($query) use ($classId, $checkEnd, $checkStart, $lecture) {
                $query->where('class_id', $classId)
                    ->where('id', '!=', $lecture->id)
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
            ->orWhere(function ($query) use ($classRoomId, $checkStart, $lecture) {
                $query->where('class_room_id', $classRoomId)
                    ->where('id', '!=', $lecture->id)
                    ->whereDate('start', '<=', $checkStart)
                    ->whereTime('start', '<', $checkStart)
                    ->whereDate('end', '>=', $checkStart)
                    ->whereTime('end', '>', $checkStart);
            })
            ->orWhere(function ($query) use ($classRoomId, $checkEnd, $lecture) {
                $query->where('class_room_id', $classRoomId)
                    ->where('id', '!=', $lecture->id)
                    ->whereDate('start', '<=', $checkEnd)
                    ->whereTime('start', '<', $checkEnd)
                    ->whereDate('end', '>=', $checkEnd)
                    ->whereTime('end', '>', $checkEnd);
            })
            ->orWhere(function ($query) use ($classRoomId, $checkEnd, $checkStart, $lecture) {
                $query->where('class_room_id', $classRoomId)
                    ->where('id', '!=', $lecture->id)
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
            ->orWhere(function ($query) use ($instructorId, $checkStart, $lecture) {
                $query->where('instructor_id', $instructorId)
                    ->where('id', '!=', $lecture->id)
                    ->whereDate('start', '<=', $checkStart)
                    ->whereTime('start', '<', $checkStart)
                    ->whereDate('end', '>=', $checkStart)
                    ->whereTime('end', '>', $checkStart);
            })
            ->orWhere(function ($query) use ($instructorId, $checkEnd, $lecture) {
                $query->where('instructor_id', $instructorId)
                    ->where('id', '!=', $lecture->id)
                    ->whereDate('start', '<=', $checkEnd)
                    ->whereTime('start', '<', $checkEnd)
                    ->whereDate('end', '>=', $checkEnd)
                    ->whereTime('end', '>', $checkEnd);
            })
            ->orWhere(function ($query) use ($instructorId, $checkEnd, $checkStart, $lecture) {
                $query->where('instructor_id', $instructorId)
                    ->where('id', '!=', $lecture->id)
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
