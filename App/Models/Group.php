<?php

namespace App\Models;

use App\Base\BaseModel;
use Exception;

class Group extends BaseModel
{
    protected static $db_table = "groups";

    public $id;
    public $name;

    public function __construct($data)
    {
        parent::__construct($data);

        if (!isset($this->name) || empty($this->name)) {
            throw new Exception("Pavadinimas yra privalomas");
        }
    }

    public function Students()
    {
        return Student::Find([['group_id', '=', $this->id]]);
    }

    public function CourseEnrollments()
    {
        return CourseEnrollment::Find([['group_id', '=', $this->id]]);
    }

    // MANY-TO-MANY RELATIONSHIP
    public function Courses()
    {
        $course_enrollments = $this->CourseEnrollments();
        $course_ids = array_map(function ($course_enrollment) {
            return $course_enrollment->course_id;
        }, $course_enrollments);

        return Course::Find([
            ['id', '$in', $course_ids],
        ]);
    }
}