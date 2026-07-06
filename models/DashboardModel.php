<?php

require_once "BaseModel.php";

class DashboardModel extends BaseModel
{

    public function getMenus($role)
    {

        $sql="

        SELECT

        m.*

        FROM

        menus m

        JOIN role_menu rm

        ON

        m.id=rm.menu_id

        WHERE

        rm.role_id=:role

        ORDER BY

        display_order

        ";

$stmt=$this->conn->prepare($sql);

$stmt->bindParam(":role",$role);

$stmt->execute();

return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}
