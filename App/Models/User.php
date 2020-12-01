<?php

namespace App\Models;

use App\Base\BaseModel;
use Exception;

class User extends BaseModel
{
    protected static $db_table = "users";

    public $id;
    public $username;
    public $password;
    public $email;
    public $contact_number;
    public $first_name;
    public $last_name;
    public $role;

    public function __construct($data)
    {
        parent::__construct($data);

        if (!isset($this->username) || empty($this->username)) {
            throw new Exception("Prisijungimo vardas yra privalomas");
        }

        if (!isset($this->password) || empty($this->password)) {
            throw new Exception("Slaptažodis yra privalomas");
        }

        if (!isset($this->email) || empty($this->email)) {
            throw new Exception("Elektroninis paštas yra privalomas");
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Neteisingas elektroninio pašto formatas");
        }

        if (!isset($this->contact_number) || empty($this->contact_number)) {
            throw new Exception("Kontaktinis telefonas yra privalomas");
        }

        if (!isset($this->first_name) || empty($this->first_name)) {
            throw new Exception("Vardas yra privalomas");
        }

        if (!isset($this->last_name) || empty($this->last_name)) {
            throw new Exception("Pavardė yra privaloma");
        }

        if (!isset($this->role) || empty($this->role)) {
            throw new Exception("Rolė yra privaloma");
        }

        if (!in_array($this->role, ["Admin", "Student", "Teacher"])) {
            throw new Exception("Netinkama rolė");
        }
    }

    public function GetRoleTranslated()
    {
        switch ($this->role) {
            case 'Student':
                return "Studentas";

            case 'Teacher':
                return "Destytojas";

            case 'Admin':
                return "Administratorius";

            default:
                return $this->role;
        }
    }

    public function Student()
    {
        return Student::FindOne([['user_id', '=', $this->id]]);
    }

    public function Teacher()
    {
        return Teacher::FindOne([['user_id', '=', $this->id]]);
    }
}