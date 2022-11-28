<?php
    ob_start();
    // include header.php file
    include ('partials/header.php');
?>
    <!---main section--->
    <div class="main" style="height:100vh;">
        <div class="container"> 

           <?php
                $id = $_GET['id'];
            ?>

            <!-- FORM TO CHANGE PASSWORD -->
            <div class=" align-items-center d-flex justify-content-center container">
                <form action="" method="POST" class="form card mt-4 bg-light border border-outline-light px-3 py-3" style="width: 20rem;">
                    <div class="card-header bg-light h4 text-center fw-bold ">Change Password</div>
                        <div class="row">

                            <!-- CURRENT PASSWORD -->
                            <div class="mt-4">
                                <label for="currentpass" class="form-label">Current Password</label>
                                <input type="password" name="currentpass" class="form-control">  
                            </div>

                            <!-- NEW PASSWORD -->
                            <div class="mt-4" class="form-label">
                                <label for="newpass">New Password</label>
                                <input type="password" name="newpass" class="form-control">  
                            </div>

                            <!-- CONFIRM PASSWORD -->
                            <div class="mt-4">
                                <label for="confirmpass" class="form-label">Confirm Password</label>
                                <input type="password" name="confirmpass" class="form-control">  
                            </div>

                            <!-- CHANGE PASSWORD BUTTON -->
                            <div class="mt-4 text-center">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button class="btn btn-dark btn-outline-dark" type="submit" name="submit">Submit</button>
                            </div>
                        
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </div>



<?php 
    if (isset($_POST['submit'])){

        //get data from form
        $id = $_POST['id'];
        $currentpass = md5($_POST['currentpass']);
        $newpass = md5($_POST['newpass']);
        $confirmpass = md5($_POST['confirmpass']);

        //get data from DB
        $sql = "SELECT * FROM user 
            WHERE userID = $id
            AND password='$currentpass';";

        //execute query
        $res =  $conn->query($sql);

        if ($res == TRUE){
            $count = $res->num_rows;

            if($count == 1){

                //check if password matches
                if ($newpass == $confirmpass){
                    //SQL query to cahnge password
                    $sql2 = "UPDATE user
                        SET password = '$newpass'
                        WHERE userID = $id;";

                    $res2 = $conn->query($sql2);

                    if ($res == TRUE){
                        $_SESSION['pwd-changed'] = "<h2 class='success'>PASSWORD CHANGED</h2>";
                        header("location:".SITEURL."admin/manage.admin.php");
                    }
                } else {
                    $_SESSION['pwd-not-match'] = "<h2 class='failed'>PASSWORDS DIDN'T MATCH</h2>";
                    header("location:".SITEURL."admin/manage.admin.php");
                }

            } else {

                $_SESSION['user-not-found'] = "<h2 class='failed'>USER NOT FOUND</h2>";
                header("location:".SITEURL."admin/manage.admin.php"); 
            }
        }
    }
?>


<?php
    include ('partials/footer.php');
?>