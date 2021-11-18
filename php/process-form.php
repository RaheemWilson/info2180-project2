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
$admin_details = $conn->query("SELECT users.email,users.password FROM `users`");
$issue = $conn->query("SELECT * FROM `issues` WHERE 1");


#Tables fetched based on queries 
$issue_Table = $issue->fetchAll(PDO::FETCH_ASSOC);
$admin_details_tb = $admin_details->fetchAll(PDO::FETCH_ASSOC);
?>

<?php #Checks if the admin login details match those in the database?>
<?php foreach ($admin_details_tb as $login): ?>
    <?php if ($email == $login["email"] && password_verify($userpassword, $login['password'])): ?>
        <?php # The table as well as the button created by raheem should go here using built in include() function ?>
        <table>
          <thead>
             <tr>
                 <th scope="col"><?= "Title" ?></th>
                 <th scope="col"><?= "Type"?></th>
                 <th scope="col"><?= "Status" ?></th>
                 <th scope="col"><?= "AssignedTo" ?></th>
             </tr>
          </thead>
        </table>
    <?php endif; ?>
<?php endforeach; ?>