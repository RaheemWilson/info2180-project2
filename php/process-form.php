<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
?>

<?php
$cmd=$_POST['status'];

switch ($cmd) {
    case "login":
        $email = $_POST['email'];
        $password = $_POST['password'];
        $output = array("message" => "Login succesful");
      break;
}

echo json_encode($output);