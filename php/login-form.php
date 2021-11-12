<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
?>

<div class="login">
    <div> 
        <h1>Welcome!</h1>
        <p id="form-desc">Please enter your login details to gain access to the BugMe Issue Tracker System.</p>
        <form id="login-form" method="post">
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email"/>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" />
            </div>
            <button type="submit" class="submit-btn">Login</button>
        </form>
    </div>
</div>


