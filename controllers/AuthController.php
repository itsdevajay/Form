<?php

require_once "../models/UserModel.php";

class AuthController
{

    public function login()
    {

        $username=$_POST['username'];
        $password=$_POST['password'];

        $userModel=new UserModel();

        $user=$userModel->login($username,$password);

        if($user){

            session_start();

            $_SESSION['user']=$user;

            echo json_encode([
                "status"=>true
            ]);

        }else{

            echo json_encode([
                "status"=>false,
                "message"=>"Invalid Username or Password"
            ]);

        }

    }

}
