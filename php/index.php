<?php
session_start();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include_once "schema.php";
include_once "process-form.php";
include_once "queries.php";

$conn = initialiseDatabase();


if($_SERVER["REQUEST_METHOD"] == "GET"){
  if(isset($_GET["user"])){
    if($_GET["user"] == "all"){
      $users = getUsers($conn);
      http_response_code(200);
      echo json_encode($users);
    }
  }

  
} elseif($_SERVER["REQUEST_METHOD"] == "POST"){
  $post = json_decode(file_get_contents('php://input'), true);

  if(isset($post)){
    $cmd=$post['status'];

      if($cmd == "login"){
          $email = $post['email'];
          $password = $post['password'];
          $result = checkEntry($email, $password, $conn);
          if($result){
            $_SESSION["email"] = $email;
            http_response_code(200);
            echo json_encode(array("message" => "User was succesfully logged in"));
          }else{
            http_response_code(500);
            echo json_encode(array("message" => "User not found"));
          }
      } elseif($cmd == "add-user"){
        //$result = TRUE;
        $result = addUser($post, $conn);
        if($result){
          http_response_code(201);
          echo json_encode(array("message" => "User was succesfully added"));
          
        }else{
          http_response_code(500);
          echo json_encode(array("message" => "User not created"));
        }
      }
      elseif($cmd == "new-issue"){
        //$result = TRUE;
        $result = addNewIssue($post, $conn);
        if($result){
          http_response_code(201);
          echo json_encode(array("message" => "Issue was succesfully added"));
          
        }else{
          http_response_code(500);
          echo json_encode(array("message" => "Issue not created"));
        }
      }
    
  }
}


      



