<?php

namespace App\Base;

class BaseController
{
    public function Redirect($to = "back")
    {
        if ($to === "back") {
            $to = $_SERVER['HTTP_REFERER'];
        }

        header('Location: ' . $to);
        die();
    }

    public function View($view, $params = [])
    {
        $view = str_replace(".", "\\", $view);

        extract($params);
        include __DIR__ . "\\..\\Views\\Shared\\Header.php";
        include __DIR__ . "\\..\\Views\\" . $view . ".php";
        include __DIR__ . "\\..\\Views\\Shared\\Footer.php";
    }

    public function DieNotFound()
    {
        header('HTTP/1.0 404 Not Found');
        die();
    }
}