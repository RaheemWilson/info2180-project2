<?php

function getUsers($conn){
    $user = $conn ->query("SELECT firstname, lastname, id  FROM `users` WHERE 1");
    $username = $user->fetchAll(PDO::FETCH_ASSOC);

    return $username;
}

function getIssues ($conn){
    $results = $conn->query("SELECT * FROM `issues`");
    $issues = $results->fetchAll(PDO::FETCH_ASSOC);
    return $issues;
}
?>