<?php

class Database
{
    private $host = "localhost";
    private $dbname = "workflow_db";
    private $user = "postgres";
    private $password = "zxcv";

    public function connect()
    {
        try {

            $conn = new PDO(
                "pgsql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->password
            );

            $conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $conn;

        } catch(PDOException $e){

            die($e->getMessage());

        }
    }
}
