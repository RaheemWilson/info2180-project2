<?php
$host = 'localhost';
$username = 'project_2_user';
$password = 'password123';
$dbname = 'bugme';

//$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

try {
    $conn = new PDO(
        'mysql:host=' . $host . ';dbname=' . $dbname,
        $username,
        $password
    );
    echo "This connected!";
} catch (Exception $e) {
    die($e->getMessage());
}



$user_entered_pw = 'password123';

$hashed_pw = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO `users` (id, firstname, lastname, email, password, date_joined) VALUES (1,'Admin','Account','admin@project2.com','$hashed_pw',now())";

$conn->query($sql);

/*
$data = [
    'name' => $id,
    'surname' => $surname,
    'sex' => $sex,

    $id, 
    $firstname, 
    $lastname, 
    $email, 
    $password, 
    $date_joined
];
$sql = "INSERT INTO users (name, surname, sex) VALUES (:name, :surname, :sex)";
$stmt= $pdo->prepare($sql);
$stmt->execute($data);
*/
//use password_verify() to check hashed_pw

//password_verify($user_entered_pw, $hashed_pw)


?>