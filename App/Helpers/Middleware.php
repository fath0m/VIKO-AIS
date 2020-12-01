<?php

namespace App\Helpers;

use Exception;

class Middleware
{
    public static function IsLoggedIn()
    {
        if (!isset($_SESSION['user'])) {
            header('location: /Authentication/Login');
            exit();
        }
    }

    public static function IsLoggedOut()
    {
        if (isset($_SESSION['user'])) {
            header('location: /');
            exit();
        }
    }

    public static function IsInRole($role = "Student")
    {
        if (!in_array($role, ["Admin", "Teacher", "Student"])) {
            throw new Exception("Invalid role supplied");
        }

        // asume that logged in user is required to have a role
        self::IsLoggedIn();

        $user = unserialize($_SESSION["user"]);

        if ($user->role !== $role) {
            header('location: /');
            exit();
        }
    }
}