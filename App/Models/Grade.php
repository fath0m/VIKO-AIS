<?php

namespace App\Models;

use App\Base\BaseModel;
use Exception;

class Grade extends BaseModel
{
    protected static $db_table = "grades";

    public $id;
    public $value;
    public $course_id;
    public $student_id;
    public $grade_date;

    public function __construct($data)
    {
        parent::__construct($data);

        if (!isset($this->value) || empty($this->value)) {
            throw new Exception("Pažymys yra privalomas");
        }

        if ($this->value < 0 || $this->value > 10) {
            throw new Exception("Pažimys gali būti tik nuo 0 iki 10");
        }

        if (!isset($this->course_id)) {
            throw new Exception("Kursas yra privalomas");
        }

        if (!isset($this->student_id)) {
            throw new Exception("Studentas yra privalomas");
        }

        if (!isset($this->grade_date) || empty($this->grade_date)) {
            throw new Exception("Įvertinimo data yra privaloma");
        }

    }

    public function Student()
    {
        return Student::FindOne([['id', '=', $this->student_id]]);
    }

    public function Course()
    {
        return Course::FindOne([['id', '=', $this->course_id]]);
    }
}