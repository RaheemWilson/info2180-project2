<?php
function initialiseDatabase(){
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
    } catch (Exception $e) {
        die($e->getMessage());
    }

    $user_entered_pw = 'password123';
    $hashed_pw = password_hash($password, PASSWORD_DEFAULT);


    $sql_check = "SELECT COUNT(*) FROM users where id = 1";
    $res = $conn->query($sql_check);
    $count = $res->fetchColumn();

    if($count == 0){
        $sql = "INSERT INTO `users` (id, firstname, lastname, email, password, date_joined) VALUES (1,'Admin','Account','admin@project2.com','$hashed_pw',now())";
        $conn->query($sql);
    }
        
    return $conn;
}

function initialiseconnection(){
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
    } catch (Exception $e) {
        die($e->getMessage());
    }
    return $conn;
}

    
?>