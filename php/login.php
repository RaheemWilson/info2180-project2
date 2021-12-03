<?php 

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include_once "schema.php";

$conn = initialiseDatabase(); 

$post = json_decode(file_get_contents('php://input'), true);

if(isset($post)){

    $email = $post['email'];
    $password = $post['password'];

    $user_details_tb = $conn->query("SELECT users.email,users.password FROM `users`");
    $issuetable = $conn->query("SELECT title, type, status, assigned_to, created FROM `issues` WHERE 1");

    #Tables fetched based on queries 
    $user_details = $user_details_tb->fetchAll(PDO::FETCH_ASSOC);
    $issue_table = $issuetable->fetchAll(PDO::FETCH_ASSOC);

    $loggedIn = FALSE;
    #Checks if the login details entered by a user match those in the database
    foreach ($user_details as $userdata){
        if ($email == $userdata['email'] && password_verify($password, $userdata['password'])){
            session_start();
            $_SESSION["email"] = "hello";
            $loggedIn = TRUE;
        }       
    }
    echo session_id();
    if($loggedIn){
        http_response_code(200);
        echo json_encode(array("message" => "User was succesfully logged in"));
    }else{
        http_response_code(500);
        echo json_encode(array("message" => "User not found"));
    }

}
?>