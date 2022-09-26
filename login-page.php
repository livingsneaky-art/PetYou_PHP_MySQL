<?php
    ob_start();
    // include header.php file
    include ('header.php');
?>

<form action="" method="POST" class="form">
    <div>
        <label for="username">username</label>
        <input type="text" name="username" required>
    </div>
    <div>
        <label for="password">password</label>
        <input type="text" name="password" required>
    </div>
   
    <button class="button" type="submit" name="submit">Login</button>
</form>


<?php

// include footer.php file
include ('footer.php');
?>