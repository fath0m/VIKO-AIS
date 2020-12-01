<?php

namespace App\Controllers\Student;

use App\Base\BaseController;
use App\Models\Course;
use App\Models\CourseEnrollment;

class CourseController extends BaseController
{
    public function GetShow($id)
    {
        $user = unserialize($_SESSION["user"]);
        $student = $user->Student();

        $course = Course::FindOne([
            ['id', '=', $id],
        ]);

        if ($course === null) {
            return $this->DieNotFound();
        }

        $course_enrollment = CourseEnrollment::FindOne([
            ['course_id', '=', $course->id],
            ['group_id', '=', $student->group_id],
        ]);

        if ($course_enrollment === null) {
            return $this->DieNotFound();
        }

        return $this->View("Student.Courses.Show", [
            'course' => $course,
            'student' => $student,
        ]);
    }
}