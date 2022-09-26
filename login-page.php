<?php
    ob_start();
    // include header.php file
    include ('header-outsider.php');
?>
<div class="main">
        <div class="container">
                <?php
                    if (isset($_SESSION['no-login-message'])){
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']);
                    }
                ?>
            <div class="login-wrapper">
                <h2>
                    Login
                </h2>

                <?php
                    if (isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <form action="" method="POST">
                    <div>
                            <label for="username">Username</label>
                            <br>
                            <input type="text" name="username">  
                    </div>
                    <br>
                    <div>
                            <label for="password">Password</label>
                            <br>
                            <input type="password" name="password">  
                    </div>
                    <button class="button" type="submit" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>


<?php
 if(isset($_POST['submit'])){

    //get data from form
    $username = $_POST['username'];
    $pass = md5($_POST['password']);

    //get data from DB
    $sql = "SELECT * FROM user
        WHERE uName = '$username'
        AND password = '$pass';";

    //execute the the query
    $res =  mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1){

        $_SESSION['user'] = $username;

        header("location:".SITEURL."home-page.php");
    } else {
        $_SESSION['login'] = "<h5 class='failed'>USERNAME OR PASSWORD DID NOT MATCH</h5>";
        header("location:".SITEURL."login-page.php");
    }
}else {
    session_unset();
    session_destroy();
}
// include footer.php file
include ('footer.php');
?>