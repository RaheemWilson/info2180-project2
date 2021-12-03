<?php

function allIssues ($conn){
    $results = $conn->query("SELECT * FROM `issues`");
    $results->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function getIssue($conn, $id){
    $results = $conn->query("SELECT * FROM `issues` WHERE id = '$id'");
    $results->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

?>