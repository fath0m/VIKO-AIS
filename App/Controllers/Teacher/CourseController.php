<?php

namespace App\Controllers\Teacher;

use App\Base\BaseController;
use App\Models\Course;

class CourseController extends BaseController
{
    public function GetShow($id)
    {
        $user = unserialize($_SESSION["user"]);
        $teacher = $user->Teacher();

        $course = Course::FindOne([
            ['id', '=', $id],
            ['teacher_id', '=', $teacher->id],
        ]);

        if ($course === null) {
            return $this->DieNotFound();
        }

        return $this->View("Teacher.Courses.Show", [
            'course' => $course,
        ]);
    }
}