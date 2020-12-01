<?php

namespace App\Controllers;

use App\Base\BaseController;
use App\Models\Group;

class GroupController extends BaseController
{
    private function GetGroupWithValidation($id)
    {
        $group = Group::FindOne([
            ['id', '=', $id],
        ]);

        if ($group === null) {
            return $this->DieNotFound();
        }

        return $group;
    }

    public function GetIndex()
    {
        $groups = Group::All();

        return $this->View("Admin.Groups.Index", ['groups' => $groups]);
    }

    public function GetCreate()
    {
        return $this->View("Admin.Groups.Create");
    }

    public function PostCreate()
    {
        $name = $_POST["name"];

        if (!isset($name)) {
            $_SESSION['error'] = "Užpildykite formą";
            return $this->Redirect("back");
        }

        try {
            Group::Insert([
                'name' => $name,
            ]);
        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage();
            return $this->Redirect("back");
        }

        return $this->Redirect("/Admin/Groups");
    }

    public function GetShow($id)
    {
        $group = $this->GetGroupWithValidation($id);

        return $this->View("Admin.Groups.Show", [
            'group' => $group,
        ]);
    }

    public function GetEdit($id)
    {
        $group = $this->GetGroupWithValidation($id);

        return $this->View("Admin.Groups.Edit", [
            'group' => $group,
        ]);
    }

    public function PostEdit($id)
    {
        $group = $this->GetGroupWithValidation($id);

        $name = $_POST["name"];
        $group->name = $name;

        try {
            $group->Save();
        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage();
            return $this->Redirect("back");
        }

        return $this->Redirect("/Admin/Groups");
    }

    public function PostDelete($id)
    {
        $group = $this->GetGroupWithValidation($id);
        $group->Destroy();

        return $this->Redirect("/Admin/Groups");
    }
}