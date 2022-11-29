<?php
    ob_start();
    // include header.php file
    include ('partials/header.php');
?>
    <div class="main" style="height:100vh;">

<div class="container">
    <!-- <h1>UPDATE ADMIN</h1> -->

    <?php
        //Get id of admin to be edit
        $id = $_GET['id'];
        //SQL query to get data
        $sql = "SELECT * FROM user WHERE userID = $id;";

        //To execute the query
        $res = $conn->query($sql);

        if ($res == TRUE){
            $count = $res->num_rows;

            if($count == 1){
                $row = $res->fetch_assoc();
                $fName = $row['fName'];
                $lName = $row['lName'];
                $uName = $row['uName'];
            } else {
                header('location:'.SITEURL.'admin/manage.admin.php');
            }
        }
    ?>

     <!-- FORM TO UPDATE USER -->
     <div class=" align-items-center d-flex justify-content-center container">
                <form action="" method="POST" class="form card mt-4 bg-light border border-outline-light px-3 py-3" style="width: 20rem;">
                    <div class="card-header bg-light h4 text-center fw-bold ">Update User</div>
                        <div class="row">
                            <!-- FIRST NAME -->
                            <div class="mt-4">
                                    <label for="fName" class="form-label">First Name</label>
                                    <input type="text" name="fName" class="form-control" value="<?php echo $fName; ?>" required>  
                            </div>
                            <!-- LAST NAME -->
                            <div class="mt-4">
                                    <label for="lName" class="form-label">Last Name</label>
                                    <input type="text" name="lName" class="form-control" value="<?php echo $lName; ?>" required>  
                            </div>
                            <!-- USERNAME -->
                            <div class="mt-4">
                                    <label for="uName" class="form-label">Username</label>
                                    <input type="text" name="uName" class="form-control" value="<?php echo $uName; ?>" required>  
                            </div>
                            <!-- UPDATE USER BUTTON -->
                            <div class="mt-4 text-center">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button class="btn btn-primary btn-outline-secondary" type="submit" name="submit">Update</button>
                                <a href="manage.admin.php" class="btn btn-dark btn-outline-dark">Cancel</a>
                            </div>
                        
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </div>

<?php

if (isset($_POST['submit'])){
$id = $_POST['id'];
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$uName = $_POST['uName'];

//SQL query to to update admin
$sql = "UPDATE user
    SET fName = '$fName',
    lName = '$lName',
    uName = '$uName'
    WHERE userID = '$id';";

//to execute the query
$res = $conn->query($sql);

if ($res == TRUE){
    $_SESSION['update'] = "<h2 class='success'>UPDATE SUCCESSFUL</h2>";
    header("location:".SITEURL."admin/manage.admin.php");
} else {
    $_SESSION['update'] = "<h2 class='failed'>UPDATE FAILED</h2>";
    header("location:".SITEURL."admin/manage.admin.php");
}
}

?>

<?php
    include ('partials/footer.php');
?>