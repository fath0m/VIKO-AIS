<?php

namespace App\Controllers;

use App\Base\BaseController;

class DashboardController extends BaseController
{
    public function GetIndex()
    {
        $user = unserialize($_SESSION["user"]);

        if ($user->role === "Student") {
            $student = $user->Student();
            $group = $student->Group();
            $courses = [];

            if (isset($group) && $group !== null) {
                $courses = $group->Courses();
            }

            return $this->View("Dashboard.StudentIndex", [
                'student' => $student,
                'group' => $group,
                'courses' => $courses,
            ]);
        } else if ($user->role === "Teacher") {
            $teacher = $user->Teacher();
            $courses = $teacher->Courses();

            return $this->View("Dashboard.TeacherIndex", [
                'courses' => $courses,
            ]);
        }

        return $this->View("Dashboard.Index");
    }
}