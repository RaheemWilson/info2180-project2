<?php

function checkEntry($email, $password, $conn){
    #Queries done on the database
    $user_details_tb = $conn->query("SELECT users.email,users.password FROM `users`");
    $issuetable = $conn->query("SELECT title, type, status, assigned_to, created FROM `issues` WHERE 1");

    #Tables fetched based on queries 
    $user_details = $user_details_tb->fetchAll(PDO::FETCH_ASSOC);
    $issue_table = $issuetable->fetchAll(PDO::FETCH_ASSOC);

    #Checks if the login details entered by a user match those in the database
    foreach ($user_details as $userdata){
        if ($email == $userdata['email'] && password_verify($password, $userdata['password'])){
            return TRUE;
        }
        return FALSE;       
    }
}
  
    