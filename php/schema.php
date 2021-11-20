<?php
function initialize_database(){
    $host = 'localhost';
    $username = 'project_2_user';
    $password = 'password123';
    $dbname = 'bugme';

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
}
?>