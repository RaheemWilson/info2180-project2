
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
    }
    return FALSE;
}


function addUser($post, $conn){
    #Variables from form assigned.
    $firstname = $post['firstname'];
    $lastname = $post['lastname'];
    $email = $post['email'];
    $psswd = $post['password'];

    #Hashing the user entered password before inserting into database
    $hashed_pass = password_hash($psswd, PASSWORD_DEFAULT);

    #Prepare filters query from da' bad guys
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$hashed_pass')");
    
    #Result stores TRUE if query successfully executed
    $result = $stmt->execute();

    return $result;
}


function addNewIssue($post, $conn, $email){
    $title = $post['title'];
    $description = $post['description'];
    $type = $post['type'];
    $priority = $post['priority'];
    $status = 'OPEN';
    $assigned_to = $post['assigned'];
    #Grab current users email address to get their ID from database for created by field in database
    $assigned_id = $conn->query("SELECT id from users WHERE email = '$assigned_to'");
    $id = $conn->query("SELECT id from users WHERE email = '$email'");
    
    $asid = $assigned_id->fetchAll(PDO::FETCH_ASSOC);
    $id = $id->fetchAll(PDO::FETCH_ASSOC);

    echo $id['id'];
    echo implode("",$asid);

    //$assigned = $conn->query("SELECT id from users WHERE email = '$email'");
    //$id = $id->fetchAll(PDO::FETCH_ASSOC);

    #Prepare filters query from da' bad guys
    $stmt = $conn->prepare("INSERT INTO `issues` (title, description, type, priority, status, assigned_to, created_by) VALUES ('$title', '$description', '$type', '$priority', '$status', '$asid', '$id')");

    #Result stores TRUE if query successfully executed
    $result = $stmt->execute();

    return $result;
}
    