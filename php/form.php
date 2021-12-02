<?php
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST');
   header("Access-Control-Allow-Headers: X-Requested-With");
   
   include_once "schema.php";
   
   $conn = initialiseconnection();
   $user = $conn ->query("SELECT firstname, lastname  FROM `users` WHERE 1");
   $username = $user->fetchAll(PDO::FETCH_ASSOC);
?>


<?php switch($section): ?>
<?php case 'login': ?>   
    <div class="login">
        <div> 
            <h1>Welcome!</h1>
            <p id="form-desc">Please enter your login details to gain access to the BugMe Issue Tracker System.</p>
            <form id="login-form" method="post">
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required/>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required/>
                </div>
                <button type="submit" class="submit-btn">Login</button>
            </form>
        </div>
    </div>
<?php break; ?>
<?php case 'add-user': ?>
    <div> 
    <h1>New User</h1>
    <form id="add-user-form" method="post">
        <div>
            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" id="firstname"/>
        </div>
        <div>
            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" id="lastname"/>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email"/>
        </div>
        <button type="submit" class="submit-btn">Submit</button>
    </form>
    </div>
<?php break; ?>
<?php case 'new-issue' ?>
    <div> 
    <h1>Create Issue</h1>
    <form id="create-issue-form" method="post">
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title"/>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        <div>
            <label for="assigned">Assigned To</label>
            <select name="assigned" id="assigned">
            <?php foreach ($username  as $useroption): ?>
                <option><?=$useroption['firstname']." ".$useroption['lastname']?></option>
              <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="type">Type</label>
            <select name="type" id="type">
                <option value="bug">Bug</option>
                <option value="proposal">Proposal</option>
                <option value="task">Task</option>
            </select>
        </div>
        <div>
            <label for="priority">Priority</label>
            <select name="priority" id="priority">
                <option value="minor">Minor</option>
                <option value="major">Major</option>
                <option value="critical">Critical</option>
            </select>
        </div>
        <button type="submit" class="submit-btn">Submit</button>
    </form>
    </div>
<?php break; ?>
<?php endswitch; ?>
