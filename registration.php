<?php

class Registration{
    private $conn;

    public $Username;
    public $phonenumber;
    public $email;
    public $password;
    public $id;

    private $table_name= "registration";


    public function __connect($db){
        return $this->conn = $db;
    }

    public function create()
    {

        $query = /** @lang text */
            "INSERT INTO " . $this->table_name . "
            SET
                Username = :Username,
                phonenumber = :phonenumber,
                email = :email,
                password = :password";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':Username', $this->Username);
        $stmt->bindParam(':phonenumber', $this->phonenumber);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    function emailExists(){

        // query to check if email exists
        $query = /** @lang text */
            "SELECT id, Username, phonenumber
            FROM " . $this->table_name . "
            WHERE email = ? and password = ?
            LIMIT 0,1";

        // prepare the query
        $stmt = $this->conn->prepare( $query );

        // sanitize

        // bind given email value
        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2,$this->password);
        // execute the query
        $stmt->execute();

        // get number of rows
        $num = $stmt->rowCount();
        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){
            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // assign values to object properties
            $this->id = $row['id'];
            $this->Username = $row['Username'];
            $this->phonenumber = $row['phonenumber'];
            // return true because email exists in the database
            return true;
        }

        // return false if email does not exist in the database
        return false;
    }


}