<?php

function getUsers($conn){
    $user = $conn ->query("SELECT firstname, lastname, id  FROM `users` WHERE 1");
    $username = $user->fetchAll(PDO::FETCH_ASSOC);

    return $username;
}

function getIssues ($conn){
    $results = $conn->query("SELECT users.firstname, users.lastname, issues.* FROM users JOIN issues ON users.id=issues.assigned_to;");
    $issues = $results->fetchAll(PDO::FETCH_ASSOC);
    return $issues;
}

function getIssuesOpen($conn){
    $results = $conn->query("SELECT users.firstname, users.lastname, issues.* FROM users JOIN issues ON users.id=issues.assigned_to WHERE  issues.status='OPEN';");
    $issues = $results->fetchAll(PDO::FETCH_ASSOC);
    return $issues;
}

function getIssuesUser($conn){
    $userId = $_SESSION["userId"];
    $results = $conn->query("SELECT users.firstname, users.lastname, issues.* FROM users JOIN issues ON users.id=issues.assigned_to WHERE issues.assigned_to = '$userId';");
    $issues = $results->fetchAll(PDO::FETCH_ASSOC);
    return $issues;
}

function getIssue($conn, $id){
    
    $results = $conn->query("SELECT * FROM issues WHERE id = '$id'");
    $issue = $results->fetchAll(PDO::FETCH_ASSOC);

    $created = $issue[0]['created_by'];

    $query = $conn ->query("SELECT firstname, lastname FROM `users` WHERE id = '$created'");
    $userCreated = $query->fetchAll(PDO::FETCH_ASSOC);

    $assigned = $issue[0]['assigned_to'];

    $query = $conn ->query("SELECT firstname, lastname FROM `users` WHERE id = '$assigned'");
    $userAssigned = $query->fetchAll(PDO::FETCH_ASSOC);
   
    $newIssue = $issue[0];

    $newIssue["assigned_to"] = $userAssigned[0];
    $newIssue["created_by"] = $userCreated[0];

    return $newIssue;
}
?>