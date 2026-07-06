<?php

require_once "BaseModel.php";

class UserModel extends BaseModel
{

    public function login($username,$password)
    {

        $sql="SELECT u.id, u.username, u.full_name, u.role_id, u.manager_id, r.role_name FROM users u JOIN roles r ON u.role_id=r.id WHERE username=:username AND password=:password";

        $stmt=$this->conn->prepare($sql);

        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":password",$password);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }
    public function getUserById($id)
    {
        $sql = "
            SELECT
                id,
                username,
                full_name,
                role_id,
                manager_id
            FROM users
            WHERE id = :id
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
