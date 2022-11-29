<?php
   ob_start();
    // include header.php file
    include ('partials/header.php');
?>
  <!---main section--->
    <div class="main">
        <!-- <div class="add-body" style="height:57.6vh"> -->
            <div class="container">
                <!-- <h1>ADD ADMIN</h1> -->

                <!-- FORM TO ADD USER-->
                <div class=" align-items-center d-flex justify-content-center container">
                    <form action="" method="POST" class="form card mt-4 bg-light border border-outline-light px-3 py-3" style="width: 20rem;">
                        <div class="card-header bg-light h4 text-center fw-bold ">Add Admin</div>
                            <div class="row">
                                <!-- FIRST NAME -->
                                <div class="mt-4">
                                    <label for="first-name" class="form-label">First Name</label>
                                    <input type="text" name="first-name" class="form-control" required>  
                                </div>
                                <!-- LAST NAME -->
                                <div class="mt-4">
                                    <label for="last-name" class="form-label">Last Name</label>
                                    <input type="text" name="last-name" class="form-control" required>  
                                </div>
                                <!-- USERNAME -->
                                <div class="mt-4">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" required>  
                                </div>
                                <!-- PASSWORD -->
                                <div class="mt-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" required>  
                                </div>
                                <!--ADD ADMIN BUTTON -->
                                <div class="mt-4 text-center">
                                    <button class="btn btn-primary btn-outline-secondary" type="submit" name="submit">Add</button>
                                    <a href="manage.admin.php" class="btn btn-dark btn-outline-dark">Cancel</a>
                                </div>                  
                            </div>
                        </div>  
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
                    $sql = "INSERT INTO user(fName, lName, uName, password, user_type)
                    VALUES('$firstName', '$lastName', '$username', '$pwd', 'Admin');";
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