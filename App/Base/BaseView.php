<?php

namespace App\Base;

use Exception;

class BaseView extends BaseModel
{
    public function __construct($data)
    {
        parent::__construct($data);
    }

    public static function Insert($values)
    {
        throw new Exception("Unable to insert a view");
    }
}