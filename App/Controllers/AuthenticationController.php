<?php
namespace App\Controllers;

use App\Base\BaseController;
use App\Models\User;

class AuthenticationController extends BaseController
{
    public function GetLogin()
    {
        return $this->View("Authentication.Login");
    }

    public function PostLogin()
    {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (!isset($username) || !isset($password)) {
            $_SESSION['error'] = "Užpildykite formą";
            return $this->Redirect("back");
        }

        $user = User::FindOne([[
            'username', '=', $username,
        ]]);

        if ($user === null) {
            $_SESSION['error'] = "Vartotojas neegzistuoja";
            return $this->Redirect("back");
        }

        if ($user->password !== $password) {
            $_SESSION['error'] = "Neteisingas slaptažodis";
            return $this->Redirect("back");
        }

        $_SESSION["user"] = serialize($user);

        return $this->Redirect("/");
    }

    public function GetRegister()
    {

    }

    public function GetLogout()
    {
        session_destroy();

        return $this->Redirect("/Authentication/Login");
    }
}