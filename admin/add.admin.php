<?php
   ob_start();
    // include header.php file
    include ('partials/header.php');
?>
  <!---main section--->
  <div class="main">
        <div class="add-body" style="height:57.6vh">
            <div class="container">
                <h1>ADD ADMIN</h1>

                <form action="" method="POST" class="form">
                    <div>
                            <label for="first-name">First Name</label>
                            <input type="text" name="first-name" required>  
                    </div>
                    <div>
                            <label for="last-name">Last Name</label>
                            <input type="text" name="last-name" required>  
                    </div>
                    <div>
                            <label for="username">Username</label>
                            <input type="text" name="username" required>  
                    </div>
                    <div>
                            <label for="password">Password</label>
                            <input type="password" name="password" required>  
                    </div>
                    <button class="button" type="submit" name="submit">Submit</button>
                </form>

            </div>
        </div>
    </div>

<?php
    include('partials/footer.php');
?>

<?php

    //TO ADD VALUES TO ADMIN TABLE

    if(isset($_POST['submit'])){

        //GET DATA FROM FORM
        $firstName = trim($_POST['first-name']);
        $lastName = trim($_POST['last-name']);
        $username = trim($_POST['username']);
        $pwd = trim(md5($_POST['password']));

        $check_username = $conn->query("SELECT uName FROM user where uName = '$username'");
        if(empty($firstName) || empty($lastName) && empty($username) || empty($pwd)){
            $message = "You must enter user details";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }else{
            if($check_username->num_rows > 0){
                $message = "Username already taken";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }else {
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    //SQL QUERY TO INSERT TO DB
                    $sql = "INSERT INTO user(fName, lName, uName, password)
                    VALUES('$firstName', '$lastName', '$username', '$pwd');";
                }

                //EXECUTING QUERY AND SAVING TO DB
                $res = $conn->query($sql) or die(mysqli_error($conn));

                //TO CHECK IF QUEY IS EXECUTED
                if ($res == TRUE){
                    $_SESSION['add'] = "<h2 class='success'>OPERATION SUCCESSFUL</h2>";
                    header("location:".SITEURL."admin/manage.admin.php");
                } else {
                    $_SESSION['add'] = "<h2 class='failed'>OPERATION FAILED</h2>";
                    header("location:".SITEURL."admin/manage.admin.php");
                }

            }
        }

      
        
    }

?>