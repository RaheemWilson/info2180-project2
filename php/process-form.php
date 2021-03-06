<?php

function checkEntry($email, $password, $conn){
    #Queries done on the database
    $user_details_tb = $conn->query("SELECT users.email,users.password, users.id FROM `users`");
    $issuetable = $conn->query("SELECT title, type, status, assigned_to, created FROM `issues` WHERE 1");

    #Tables fetched based on queries 
    $user_details = $user_details_tb->fetchAll(PDO::FETCH_ASSOC);
    $issue_table = $issuetable->fetchAll(PDO::FETCH_ASSOC);

    #Checks if the login details entered by a user match those in the database
    foreach ($user_details as $userdata){
        if ($email == $userdata['email'] && password_verify($password, $userdata['password'])){
            $_SESSION["userId"] = $userdata["id"];
            return TRUE;
        }       
    }
    return FALSE;
}


function addUser($post, $conn){
    #Variables from form assigned.
    $firstname = filter_var(htmlspecialchars($post['firstname']), FILTER_SANITIZE_STRING);
    $lastname = filter_var(htmlspecialchars($post['lastname']), FILTER_SANITIZE_STRING);
    $email = filter_var(htmlspecialchars($post['email']), FILTER_SANITIZE_EMAIL);
    $psswd = filter_var(htmlspecialchars($post['password']), FILTER_SANITIZE_STRING);
    
    #Hashing the user entered password before inserting into database
    $hashed_pass = password_hash($psswd, PASSWORD_DEFAULT);

    #Prepare filters query from da' bad guys
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$hashed_pass')");
    
    #Result stores TRUE if query successfully executed
    $result = $stmt->execute();

    return $result;
}


function addNewIssue($post, $conn){
   
    $title = filter_var(htmlspecialchars($post['title']), FILTER_SANITIZE_STRING);
    $description = filter_var(htmlspecialchars($post['description']), FILTER_SANITIZE_STRING);
    $type = $post['type'];
    $priority = $post['priority'];
    $status = 'OPEN';
    $assigned_to = intval($post['assigned']);

    $id = $_SESSION["userId"];

    #Prepare filters query
    $stmt = $conn->prepare("INSERT INTO `issues` (title, description, type, priority, status, assigned_to, created_by, created, updated) 
                            VALUES ('$title', '$description', '$type', '$priority', '$status', $assigned_to, '$id', SYSDATE(), SYSDATE())");

    #Result stores TRUE if query successfully executed
    $result = $stmt->execute();

    return TRUE;
}
    