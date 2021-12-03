<?php 
session_start();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include_once "schema.php";

echo session_id();
echo json_encode($_SESSION);

$conn = initialiseDatabase(); 

$post = json_decode(file_get_contents('php://input'), true);


if(isset($post)){
    $title = $post['title'];
    $description = $post['description'];
    $type = $post['type'];
    $priority = $post['priority'];
    $status = 'OPEN';
    $assigned_to = intval($post['assigned']);
 
    

    $result = TRUE;
    if($result){
        http_response_code(201);
        echo json_encode(array("message" => "User was succesfully added"));
        
      }else{
        http_response_code(500);
        echo json_encode(array("message" => "User not created"));
      }
}
?>