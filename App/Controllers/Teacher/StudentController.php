<?php

namespace App\Controllers\Teacher;

use App\Base\BaseController;
use App\Models\Course;

class StudentController extends BaseController
{
    public function GetIndex($courseId)
    {
        $user = unserialize($_SESSION["user"]);
        $teacher = $user->Teacher();

        $course = Course::FindOne([
            ['id', '=', $courseId],
            ['teacher_id', '=', $teacher->id],
        ]);

        if ($course === null) {
            return $this->DieNotFound();
        }

        $students = $course->Students();

        return $this->View("Teacher.Students.Index", [
            'course' => $course,
            'students' => $students,
        ]);
    }
}