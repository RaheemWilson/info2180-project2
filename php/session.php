<?php 
session_start();

function sessionEmail($email){
    $_SESSION["userEmail"] = $email;
}

function getEmail(){
    if(isset($_SESSION["userEmail"])){
        return $_SESSION["userEmail"];
    }
    return "";  
}
?>