<?php

header("Access-Control-Allow-Origin: http://localhost/Api_login/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'database.php';
include_once 'registration.php';


$data = new DatabaseService();
$db = $data->getConnection();

$user_register = new Registration();
$register = $user_register->__connect($db);

$data = json_decode(file_get_contents("php://input"));


$user_register->Username = $data->Username;
$user_register->phonenumber = $data->phonenumber;
$user_register->email = $data->email;
$user_register->password = $data->password;


if(
    !empty($user_register->Username) &&
    !empty($user_register->phonenumber) &&
    !empty($user_register->email) &&
    !empty($user_register->password) &&
    $user_register->create()
){
    http_response_code(200);

    // display message: user was created
    echo json_encode(array("message" => "User was created."));
}

else{
    http_response_code(400);

    // display message: unable to create user
    echo json_encode(array("message" => "Unable to create user."));
}