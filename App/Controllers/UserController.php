<?php

namespace App\Controllers;

use App\Base\BaseController;
use App\Models\Group;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;

class UserController extends BaseController
{
    private function GetUserWithValidation($id)
    {
        $user = User::FindOne([[
            'id', '=', $id,
        ]]);

        if ($user === null) {
            return $this->DieNotFound();
        }

        return $user;
    }

    public function GetIndex()
    {
        $users = User::All();

        return $this->View("Admin.Users.Index", ['users' => $users]);
    }

    public function GetCreate()
    {
        $groups = Group::All();

        return $this->View("Admin.Users.Create", [
            'groups' => $groups,
        ]);
    }

    public function PostCreate()
    {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $contact_number = $_POST["contact_number"];
        $role = $_POST["role"];

        $user = User::Insert([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'contact_number' => $contact_number,
            'role' => $role,
        ]);

        if ($user->role === "Student") {
            $group = $_POST["group"];

            Student::Insert([
                'group_id' => $group,
                'user_id' => $user->id,
            ]);
        }

        if ($user->role === "Teacher") {
            Teacher::Insert([
                'user_id' => $user->id,
            ]);
        }

        return $this->Redirect("/Admin/Users");
    }

    public function GetShow($id)
    {
        $user = $this->GetUserWithValidation($id);

        return $this->View("Admin.Users.Show", [
            'user' => $user,
        ]);
    }

    public function GetEdit($id)
    {
        $user = $this->GetUserWithValidation($id);
        $groups = Group::All();

        return $this->View("Admin.Users.Edit", [
            'user' => $user,
            'groups' => $groups,
        ]);
    }

    public function PostEdit($id)
    {
        $user = $this->GetUserWithValidation($id);

        $user->first_name = $_POST["first_name"];
        $user->last_name = $_POST["last_name"];
        $user->email = $_POST["email"];
        $user->password = $_POST["password"];
        $user->contact_number = $_POST["contact_number"];

        if ($user->role === "Student") {
            $student = $user->Student();
            $new_group_id = $_POST["group"];

            if ($student->group_id != $new_group_id) {
                $student->group_id = $new_group_id;

                try {
                    $student->Save();
                } catch (\Throwable $th) {
                    $_SESSION['error'] = $th->getMessage();
                    return $this->Redirect("back");
                }
            }
        }

        try {
            $user->Save();
        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage();
            return $this->Redirect("back");
        }

        return $this->Redirect("/Admin/Users");
    }

    public function PostDelete($id)
    {
        $user = $this->GetUserWithValidation($id);
        $user->Destroy();

        return $this->Redirect("/Admin/Users");
    }
}