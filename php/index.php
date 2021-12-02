<?php
    session_start();  
    function sessionEmail($email){
       $_SESSION["useremail"] = $email;
       return $_SESSION["useremail"];
    }
?>

<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST');
  header("Access-Control-Allow-Headers: X-Requested-With");
  
  include_once "schema.php";
  include_once "process-form.php";

  $ses_email = "";
  $conn = initialiseDatabase();

if($_SERVER["REQUEST_METHOD"] == "GET"){
  if(isset($_GET["section"])){
    $section = $_GET["section"];
    include "form.php";
  } 
} elseif($_SERVER["REQUEST_METHOD"] == "POST"){
  $post = json_decode(file_get_contents('php://input'), true);

  if(isset($post)){
    $cmd=$post['status'];

    switch ($cmd) {
      case "login":
          $email = $post['email'];
          $password = $post['password'];
          $result = checkEntry($email, $password, $conn);
          if($result){
            $ses_email = sessionEmail($email);
            include "home.php";
          }else{
            echo "User not found";
          }
      break;
      case "add-user":
        //$result = TRUE;
        $result = addUser($post, $conn);
        if($result){
          http_response_code(201);
          echo json_encode(array("message" => "User was succesfully added"));
          
        }else{
          http_response_code(500);
          echo json_encode(array("message" => "User not created"));
        }
      break;
      case "new-issue":
        //$result = TRUE;
        $result = addNewIssue($post, $conn, $ses_email);
        if($result){
          http_response_code(201);
          echo json_encode(array("message" => "Issue was succesfully added"));
          
        }else{
          http_response_code(500);
          echo json_encode(array("message" => "Issue not created"));
        }
      break;
    }
  }
}
      



