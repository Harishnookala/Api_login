<?php
header("Access-Control-Allow-Origin: http://localhost/php_api_learn/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'database.php';
include_once 'registration.php';

$database = new DatabaseService();
$db = $database->getConnection();

$login = new Registration();
$register = $login->__connect($db);

$data = json_decode(file_get_contents("php://input"));

$login->email = $data->email;
$login->password = $data->password;

$email_exists = $login->emailExists();


if ($email_exists){


    http_response_code(200);

    echo json_encode(
        array(
            "message" => "Successful login.",
            "email"=>$data->email,
            "username"=>$login->Username,
        )
    );
}

else{

    // set response code
    http_response_code(401);

    // tell the user login failed
    echo json_encode(array("message" => "Login failed."));
}


