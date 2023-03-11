<?php

namespace App\Action\Lecture;

use App\Exceptions\ClassHasLectureException;
use App\Exceptions\ClassRoomIsOccupiedException;
use App\Exceptions\InstructorHasLecturesException;
use App\Models\Lecture;
use Illuminate\Support\Carbon;

class LectureReserveUpdateAction
{
    public function __invoke(Lecture $lecture, array $reserveData): Lecture
    {
        $start = $reserveData['start'] ?? $lecture->start;
        $end = $reserveData['end'] ?? $lecture->end;
        $checkStart = Carbon::createFromTimeString($start)->addMinute();
        $checkEnd = Carbon::createFromTimeString($end)->addMinute();
        $classId = $reserveData['class_id'] ?? $lecture->class_id;
        $classRoomId = $reserveData['class_room_id'] ?? $lecture->class_room_id;
        $instructorId = $lecture->instructor_id;
        $name = $reserveData['name'] ?? $lecture->name;

        $lectures = Lecture::query()
            ->orWhere([
                ['class_id', '=', $classId],
                ['start', '>', $checkStart],
                ['start', '<', $checkEnd],
                ['id', '!=', $lecture->id]
            ])
            ->orWhere([
                ['class_id', '=', $classId],
                ['end', '>', $checkStart],
                ['end', '<', $checkEnd],
                ['id', '!=', $lecture->id]
            ]);

        if (
            $lectures->count() > 0
        ) {
            throw new ClassHasLectureException($lectures->get());
        }

        $lectures = Lecture::query()
            ->orWhere([
                ['class_room_id', '=', $classRoomId],
                ['start', '>', $checkStart],
                ['start', '<', $checkEnd],
                ['id', '!=', $lecture->id]
            ])
            ->orWhere([
                ['class_room_id', '=', $classRoomId],
                ['end', '>', $checkStart],
                ['end', '<', $checkEnd],
                ['id', '!=', $lecture->id]
            ]);

        if (
            $lectures->count() > 0
        ) {
            throw new ClassRoomIsOccupiedException($lectures->get());
        }

        $lectures = Lecture::query()
            ->orWhere([
                ['instructor_id', '=', $instructorId],
                ['start', '>', $checkStart],
                ['start', '<', $checkEnd],
                ['id', '!=', $lecture->id]
            ])
            ->orWhere([
                ['instructor_id', '=', $instructorId],
                ['end', '>', $checkStart],
                ['end', '<', $checkEnd],
                ['id', '!=', $lecture->id]
            ]);
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
