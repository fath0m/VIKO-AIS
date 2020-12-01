<?php

namespace App\Models;

use App\Base\BaseModel;
use Exception;

class Student extends BaseModel
{
    protected static $db_table = "students";

    public $id;
    public $user_id;
    public $group_id;

    public function __construct($data)
    {
        parent::__construct($data);

        if (!isset($this->user_id)) {
            throw new Exception("Vartotojas yra privalomas");
        }
    }

    public function User()
    {
        return User::FindOne([['id', '=', $this->user_id]]);
    }

    public function Group()
    {
        return Group::FindOne([['id', '=', $this->group_id]]);
    }

    public function Grades()
    {
        return Grade::Find([[
            'student_id', '=', $this->id,
        ]]);
    }

    public function GradesGroupedByDate($course_id)
    {
        $grades = Grade::Find([
            ['student_id', '=', $this->id],
            ['course_id', '=', $course_id],
        ]);

        $grades_by_date = [];

        // sort asc
        usort($grades, function ($a, $b) {
            // since values are grouped by dates already,
            // values inside the grades_by_date array contain the same date
            $a_grade_date = strtotime($a->grade_date);
            $b_grade_date = strtotime($b->grade_date);

            return $a_grade_date - $b_grade_date;
        });

        foreach ($grades as $grade) {
            $group = $grades_by_date[$grade->grade_date];

            if (!isset($grades_by_date[$grade->grade_date])) {
                $group = [];
            }

            array_push($group, $grade);
            $grades_by_date[$grade->grade_date] = $group;
        }

        return $grades_by_date;
    }
}