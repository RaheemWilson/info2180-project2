<?php
//Dispatches the GET POST and PATCH request sent from the client
session_start();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH');
header("Access-Control-Allow-Headers: X-Requested-With");

include_once "schema.php";
include_once "process-form.php";
include_once "queries.php";
include_once "update.php";

$conn = initialiseDatabase();


if($_SERVER["REQUEST_METHOD"] == "GET"){

  if(isset($_GET["user"])){

    if($_GET["user"] == "all"){
      $users = getUsers($conn);
      http_response_code(200);
      echo json_encode($users);

    }else if($_GET["user" == "logout"]){

      if(isset($_SESSION["userId"])){
        unset($_SESSION["userId"]);
        unset($_SESSION["email"]);
        session_destroy();
        http_response_code(200);
      }
    }

  } elseif(isset($_GET["issue"])){
      $issue = getIssue($conn, $_GET["issue"]);
      http_response_code(200);
      echo json_encode($issue);

  } elseif (isset($_GET["issues"])) {
    $issues = null;
    switch ($_GET["issues"]) {
      case 'all':
        $issues = getIssues($conn);
        break;
      case 'open':
        $issues = getIssuesOpen($conn);
        break;
      case 'user':
        $issues = getIssuesUser($conn);
        break;
      default:
        http_response_code(500);
        echo json_encode(array("message" => "Issues not found"));
        break;
    }
    http_response_code(200);
    echo json_encode($issues);  
      
  }
  
} elseif($_SERVER["REQUEST_METHOD"] == "POST"){
  $post = json_decode(file_get_contents('php://input'), true);

  if(isset($post)){
    $cmd=$post['status'];

      if($cmd == "login"){
          $email = filter_var(htmlspecialchars($post['email']), FILTER_SANITIZE_EMAIL);
          $password = filter_var(htmlspecialchars($post['password']), FILTER_SANITIZE_STRING);
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
} elseif($_SERVER["REQUEST_METHOD"] == "PATCH"){
  $post = json_decode(file_get_contents('php://input'), true);
  $result = updateStatus($conn, $post);
  if($result){
    http_response_code(200);
    echo json_encode(array("message" => "Issue was succesfully updated"));
    
  }else{
    http_response_code(500);
    echo json_encode(array("message" => "Issue not updated"));
  }
}


      



