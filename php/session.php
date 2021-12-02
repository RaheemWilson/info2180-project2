<?php
    session_start();  
    function sessionEmail($email){
       $_SESSION["useremail"] = $email;
       return $_SESSION["useremail"];
    }
?>