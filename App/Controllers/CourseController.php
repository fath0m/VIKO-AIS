<?php

namespace App\Controllers;

use App\Base\BaseController;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Group;
use App\Models\Teacher;
use App\Models\User;

class CourseController extends BaseController
{
    private function GetCourseWithValidation($id)
    {
        $course = Course::FindOne([[
            'id', '=', $id,
        ]]);

        if ($course === null) {
            $this->DieNotFound();
        }

        return $course;
    }

    public function GetIndex()
    {
        $courses = Course::All();

        return $this->View("Admin.Courses.Index", [
            'courses' => $courses,
        ]);
    }

    public function GetCreate()
    {
        $teachers = User::Find([['role', '=', 'Teacher']]);
        $groups = Group::All();

        return $this->View("Admin.Courses.Create", [
            'teachers' => $teachers,
            'groups' => $groups,
        ]);
    }

    public function PostCreate()
    {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $teacher_user_id = $_POST["teacher_user_id"];
        $groups = $_POST["groups"] ?? [];

        if (!isset($name) || !isset($description) || !isset($teacher_user_id)) {
            $_SESSION['error'] = "Užpildykite formą";
            return $this->Redirect("back");
        }

        $teacher = Teacher::FindOne([[
            'user_id', '=', $teacher_user_id,
        ]]);

        if ($teacher === null) {
            $_SESSION['error'] = "Dėstytojas neegzistuoja";
            return $this->Redirect("back");
        }

        // create a course
        $course = Course::Insert([
            'name' => $name,
            'description' => $description,
            'teacher_id' => $teacher->id,
        ]);

        // create course enrollments
        foreach ($groups as $group) {
            // ...
            CourseEnrollment::Insert([
                'course_id' => $course->id,
                'group_id' => $group,
            ]);
        }

        return $this->Redirect("/Admin/Courses");
    }

    public function GetShow($id)
    {
        $course = $this->GetCourseWithValidation($id);

        return $this->View("Admin.Courses.Show", [
            'course' => $course,
        ]);
    }

    public function GetEdit($id)
    {
        $course = $this->GetCourseWithValidation($id);
        $teachers = User::Find([['role', '=', 'Teacher']]);
        $groups = Group::All();

        $selected_groups = $course->Groups();

        $selected_groups = array_map(function ($group) {
            return $group->id;
        }, $selected_groups);

        return $this->View("Admin.Courses.Edit", [
            'course' => $course,
            'teachers' => $teachers,
            'groups' => $groups,
            'selected_groups' => $selected_groups,
        ]);
    }

    public function PostEdit($id)
    {
        $course = $this->GetCourseWithValidation($id);

        $name = $_POST["name"];
        $description = $_POST["description"];
        $teacher_user_id = $_POST["teacher_user_id"];
        $new_groups = $_POST["groups"] ?? [];

        if (!isset($name) || !isset($description) || !isset($teacher_user_id)) {
            $_SESSION['error'] = "Užpildykite formą";
            return $this->Redirect("back");
        }

        $current_groups = $course->Groups();
        $current_group_ids = array_map(function ($group) {
            return $group->id;
        }, $current_groups);

        // check which were removed
        foreach ($current_groups as $group) {
            if (!in_array($group->id, $new_groups)) {
                // delete
                CourseEnrollment::Delete([
                    ['course_id', '=', $course->id],
                    ['group_id', '=', $group->id],
                ]);
            }
        }

        // check which were added
        foreach ($new_groups as $group_id) {
            if (!in_array($group_id, $current_group_ids)) {
                // insert
                CourseEnrollment::Insert([
                    'course_id' => $course->id,
                    'group_id' => $group_id,
                ]);
            }
        }

        return $this->Redirect("/Admin/Courses");
    }

    public function PostDelete($id)
    {
        $course = $this->GetCourseWithValidation($id);
        $course->Destroy();

        return $this->Redirect("/Admin/Courses");
    }
}