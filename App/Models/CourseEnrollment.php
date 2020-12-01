<?php

namespace App\Models;

use App\Base\BaseModel;
use Exception;

class CourseEnrollment extends BaseModel
{
    protected static $db_table = "course_enrollments";

    public $id;
    public $course_id;
    public $group_id;

    public function __construct($data)
    {
        parent::__construct($data);

        if (!isset($this->course_id)) {
            throw new Exception("Dalykas yra privalomas");
        }

        if (!isset($this->group_id)) {
            throw new Exception("Grupė yra privaloma");
        }
    }

    public function Course()
    {
        return Course::FindOne([['id', '=', $this->course_id]]);
    }

    public function Group()
    {
        return Group::FindOne([['id', '=', $this->group_id]]);
    }
}