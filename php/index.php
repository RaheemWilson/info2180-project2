<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

// include "schema.php";
?>

<?php
$cmd=$_POST['status'];

switch ($cmd) {
    case "login":
        $email = $_POST['email'];
        $password = $_POST['password'];
        $result = TRUE;

        if($result){
          session_start();
          include "home.php";
        }
    break;
}