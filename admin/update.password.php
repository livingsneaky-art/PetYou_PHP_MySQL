<?php
    ob_start();
    // include header.php file
    include ('header.php');
?>
    <!---main section--->
    <div class="main" style="height:100vh;">
        <div class="container">
           <h1>CHANGE PASSWORD</h1>

           <?php
            if (isset($_GET['id'])){
                $id = $_GET['id'];
            }
            ?>
           <form action="" method="POST" class="form">
               <div>
                    <label for="currentpass">Current Password</label>
                    <input type="password" name="currentpass">  
               </div>
               <div>
                    <label for="newpass">New Password</label>
                    <input type="password" name="newpass">  
               </div>
               <div>
                    <label for="confirmpass">Confirm Password</label>
                    <input type="password" name="confirmpass">  
               </div>
               <input type="hidden" name="id" value="<?php echo $id; ?>">
               <button class="button" type="submit" name="submit">Submit</button>
           </form>

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
        $sql = "SELECT * FROM admin 
            WHERE id = $id
            AND password='$currentpass';";

        //execute query
        $res =  $conn->query($sql);

        if ($res == TRUE){
            $count = $res->num_rows;

            if($count == 1){

                //check if password matches
                if ($newpass == $confirmpass){
                    //SQL query to cahnge password
                    $sql2 = "UPDATE admin
                        SET password = '$newpass'
                        WHERE id = $id;";

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
    include ('footer.php');
?>