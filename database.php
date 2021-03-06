<?php

class DatabaseService{

    private $db_host = "localhost";
    private $db_name = "phptutorial";
    private $db_user = "root";
    private $db_password = "";

    public function getConnection(){

        $connection = null;

        try{
            $connection = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_user, $this->db_password);
        }catch(PDOException $exception){
            echo "Connection failed: " . $exception->getMessage();
        }

        return $connection;
    }
}


