<?php
    function sessionEmail($email){
       $_SESSION["useremail"] = $email;
       return $_SESSION["useremail"];
    }
?>