<?php

namespace App\Models;

use App\Base\BaseModel;
use Exception;

class Teacher extends BaseModel
{
    protected static $db_table = "teachers";

    public $id;
    public $user_id;

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

    public function Courses()
    {
        return Course::Find([['teacher_id', '=', $this->id]]);
    }
}