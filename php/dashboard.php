<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
?>

<main>
    <aside>
    <ul>
        <li id="home">
        <img src="./assets/home_black_24dp.svg" alt="Home button">
        <p>Home</p>
        </li>
        <li id="add-user">
        <img src="./assets/person_add_black_24dp.svg" alt="">
        <p>Add User</p>
        </li>
        <li id="new-issue">
        <img src="./assets/add_box_black_24dp.svg" alt="">
        <p>Add Issue</p>
        </li>
        <li>
        <img src="./assets/power_settings_new_black_24dp.svg" alt="">
        <p>Logout</p>
        </li>
    </ul>
    </aside>

    <section>
        <?php include("form.php") ?> 
    </section>
      
</main>
