<?php

namespace App\Action\Lecture;

use App\Exceptions\ClassHasLectureException;
use App\Exceptions\ClassRoomIsOccupiedException;
use App\Exceptions\InstructorHasLecturesException;
use App\Models\Lecture;

class LectureReserveAction
{
    public function __invoke(array $reserveData): Lecture
    {
        $start = $reserveData['start'];
        $end = $reserveData['end'];
        $classId = $reserveData['class_id'];
        $classRoomId = $reserveData['class_room_id'];
        $instructorId = $reserveData['instructor_id'];

        if (
            Lecture::query()
            ->where('class_id', $classId)
            ->whereBetween('start', [$start, $end])
            ->whereBetween('stop', [$start, $end])
            ->count() > 0
        ) {
            throw new ClassHasLectureException();
        }

        if (Lecture::query()
            ->where('class_room_id', $classRoomId)
            ->whereBetween('start', [$start, $end])
            ->whereBetween('stop', [$start, $end])
            ->count() > 0
        ) {
            throw new ClassRoomIsOccupiedException();
        }

        if (Lecture::query()
            ->where('instructor_id', $instructorId)
            ->whereBetween('start', [$start, $end])
            ->whereBetween('stop', [$start, $end])
            ->count() > 0
        ) {
            throw new InstructorHasLecturesException();
        }

        $lecture = new Lecture();
        $lecture->start = $start;
        $lecture->end = $end;
        $lecture->class_id = $classId;
        $lecture->class_room_id = $classRoomId;
        $lecture->instructor_id = $instructorId;
        $lecture->save();

        return $lecture;
    }
}
