<?php

require_once "models/DashboardModel.php";

class DashboardController
{
    public function menus($role)
    {

    $model=new DashboardModel();

    return $model->getMenus($role);

    }

}
