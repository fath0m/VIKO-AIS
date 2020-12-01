<?php

namespace App\Models;

use App\Base\BaseModel;
use Exception;

class Course extends BaseModel
{
    protected static $db_table = "courses";

    public $id;
    public $name;
    public $description;
    public $teacher_id;

    public function __construct($data)
    {
        parent::__construct($data);

        if (!isset($this->name) || empty($this->name)) {
            throw new Exception("Pavadinimas yra privalomas");
        }

        if (!isset($this->description) || empty($this->description)) {
            throw new Exception("Aprašymas yra privalomas");
        }

        if (!isset($this->teacher_id)) {
            throw new Exception("Dėstytojas yra privalomas");
        }
    }

    public function Teacher()
    {
        return Teacher::FindOne([['id', '=', $this->teacher_id]]);
    }

    public function CourseEnrollments()
    {
        return CourseEnrollment::Find([['course_id', '=', $this->id]]);
    }

    // MANY-TO-MANY RELATIONSHIP
    public function Groups()
    {
        $course_enrollments = $this->CourseEnrollments();
        $group_ids = array_map(function ($course_enrollment) {
            return $course_enrollment->group_id;
        }, $course_enrollments);

        return Group::Find([
            ['id', '$in', $group_ids],
        ]);
    }

    // Artificial relationship, get students through groups many-to-many relationship
    public function Students()
    {
        $groups = $this->Groups();
        $group_ids = array_map(function ($group) {
            return $group->id;
        }, $groups);

        return Student::find([
            ['group_id', '$in', $group_ids],
        ]);
    }
}