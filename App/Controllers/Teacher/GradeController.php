<?php

namespace App\Controllers\Teacher;

use App\Base\BaseController;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Grade;
use App\Models\Student;

class GradeController extends BaseController
{
    private function GetCourseAndStudentWithValidation($courseId, $studentId)
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

        $student = Student::FindOne([
            ['id', '=', $studentId],
        ]);

        if ($student === null) {
            return $this->DieNotFound();
        }

        // check if the student is really enrolled into the course
        $course_enrollment = CourseEnrollment::FindOne([
            ['course_id', '=', $course->id],
            ['group_id', '=', $student->group_id],
        ]);

        if ($course_enrollment === null) {
            return $this->DieNotFound();
        }

        return [
            'course' => $course,
            'student' => $student,
        ];
    }

    public function GetIndex($courseId, $studentId)
    {
        $data = $this->GetCourseAndStudentWithValidation($courseId, $studentId);

        return $this->View("Teacher.Grades.Index", $data);
    }

    public function GetCreate($courseId, $studentId)
    {
        $data = $this->GetCourseAndStudentWithValidation($courseId, $studentId);

        return $this->View("Teacher.Grades.Create", $data);
    }

    public function PostCreate($courseId, $studentId)
    {
        $data = $this->GetCourseAndStudentWithValidation($courseId, $studentId);

        $course = $data["course"];
        $student = $data["student"];

        $value = $_POST["value"];
        $grade_date = $_POST["grade_date"];

        Grade::Insert([
            'value' => $value,
            'course_id' => $course->id,
            'student_id' => $student->id,
            'grade_date' => $grade_date,
        ]);

        return $this->Redirect("/Teacher/Courses/{$courseId}/Students/{$studentId}/Grades");
    }

    public function GetEdit($courseId, $studentId, $id)
    {
        $data = $this->GetCourseAndStudentWithValidation($courseId, $studentId);

        $grade = Grade::FindOne([
            ['id', '=', $id],
            ['course_id', '=', $courseId],
            ['student_id', '=', $studentId],
        ]);

        if ($grade === null) {
            return $this->DieNotFound();
        }

        $data["grade"] = $grade;

        return $this->View("Teacher.Grades.Edit", $data);
    }

    public function PostEdit($courseId, $studentId, $id)
    {
        $this->GetCourseAndStudentWithValidation($courseId, $studentId);

        $grade = Grade::FindOne([
            ['id', '=', $id],
            ['course_id', '=', $courseId],
            ['student_id', '=', $studentId],
        ]);

        if ($grade === null) {
            return $this->DieNotFound();
        }

        $grade->value = $_POST["value"];
        $grade->grade_date = $_POST["grade_date"];

        $grade->Save();

        return $this->Redirect("/Teacher/Courses/{$courseId}/Students/{$studentId}/Grades");
    }

    public function PostDelete($courseId, $studentId, $id)
    {
        $this->GetCourseAndStudentWithValidation($courseId, $studentId);

        $grade = Grade::FindOne([
            ['id', '=', $id],
            ['course_id', '=', $courseId],
            ['student_id', '=', $studentId],
        ]);

        if ($grade === null) {
            return $this->DieNotFound();
        }

        $grade->Delete();

        return $this->Redirect("/Teacher/Courses/{$courseId}/Students/{$studentId}/Grades");
    }
}