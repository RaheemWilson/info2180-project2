<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
?>

<?php
$host = 'localhost';
$username = 'project_2_user';
$password = 'password123';
$dbname = 'bugme';
$email = $_POST['email'];
$userpassword = $_POST['password'];


try {
    $conn = new PDO(
        'mysql:host=' . $host . ';dbname=' . $dbname,
        $username,
        $password
    );
    echo "This connected";
} catch (Exception $e) {
    die($e->getMessage());
}


#Queries done on the database
$user_details_tb = $conn->query("SELECT users.email,users.password FROM `users`");
$issuetable = $conn->query("SELECT title, type, status, assigned_to, created FROM `issues` WHERE 1");

#Tables fetched based on queries 
$user_details = $user_details_tb->fetchAll(PDO::FETCH_ASSOC);
$issue_table = $issuetable->fetchAll(PDO::FETCH_ASSOC);
?>

<?php #Checks if the login details entered by a user match those in the database?>
<?php foreach ($user_details as $userdata): ?>
    
    <?php # checks login email and password for admin?>
    <?php if ($email == $userdata['email'] && password_verify($userpassword, $userdata['password'])): ?>
        
        <?php include 'issues-table.php';?>
        <?php include 'features-buttons.php'?>
  
    <?php else: ?>
       <?php #this part should reload the login page if the user entry is wrong?>  
        
       <?php include 'login-form.php'?>
    
    <?php endif; ?>  
<?php endforeach; ?>