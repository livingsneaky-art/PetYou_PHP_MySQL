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
        $id = 0;
        //SQL query to get data
        $sql = "SELECT * FROM discount WHERE discountID = $id;";

        //To execute the query
        $res = $conn->query($sql);

        if ($res == TRUE){
            $count = $res->num_rows;

            if($count == 1){
                $row = $res->fetch_assoc();
                $discountA = $row['discountA'];
                $discountB = $row['discountB'];
                $discountC = $row['discountC'];
                $discountD = $row['discountD'];
            } else {
                header('location:'.SITEURL.'admin/manage.discounts.php');
            }
        }
    ?>

     <!-- FORM TO UPDATE USER -->
     <div class=" align-items-center d-flex justify-content-center container">
                <form action="" method="POST" class="form card mt-4 bg-light border border-outline-light px-3 py-3" style="width: 20rem;">
                    <div class="card-header bg-light h4 text-center fw-bold ">Update Discount</div>
                        <div class="row">
                            <!-- DISCOUNT A -->
                            <div class="mt-4">
                                    <label for="discountA" class="form-label">First Name</label>
                                    <input type="text" name="discountA" class="form-control" value="<?php echo $discountA; ?>" required>  
                            </div>
                            <!-- DISCOUNT B -->
                            <div class="mt-4">
                                    <label for="discountB" class="form-label">Last Name</label>
                                    <input type="text" name="discountB" class="form-control" value="<?php echo $discountB; ?>" required>  
                            </div>
                            <!-- DISCOUNT C -->
                            <div class="mt-4">
                                    <label for="discountC" class="form-label">Username</label>
                                    <input type="text" name="discountC" class="form-control" value="<?php echo $discountC; ?>" required>  
                            </div>
                            <!-- DISCOUNT D -->
                            <div class="mt-4">
                                    <label for="discountD" class="form-label">Username</label>
                                    <input type="text" name="discountD" class="form-control" value="<?php echo $discountD; ?>" required>  
                            </div>
                            <!-- UPDATE DISCOUNT BUTTON -->
                            <div class="mt-4 text-center">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button class="btn btn-primary btn-outline-secondary" type="submit" name="submit">Update</button>
                                <a href="manage.discounts.php" class="btn btn-dark btn-outline-dark">Cancel</a>
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
$discountA = $row['discountA'];
$discountB = $row['discountB'];
$discountC = $row['discountC'];
$discountD = $row['discountD'];

//SQL query to to update admin
$sql = "UPDATE discount
    SET discountA = '$discountA',
    discountB = '$discountB',
    discountC = '$discountC',
    discountD = '$discountD'
    WHERE discountID = '$id';";

//to execute the query
$res = $conn->query($sql);

if ($res == TRUE){
    $_SESSION['update'] = "<h2 class='success'>UPDATE SUCCESSFUL</h2>";
    header("location:".SITEURL."admin/manage.discounts.php");
} else {
    $_SESSION['update'] = "<h2 class='failed'>UPDATE FAILED</h2>";
    header("location:".SITEURL."admin/manage.discounts.php");
}
}

?>

<?php
    include ('partials/footer.php');
?>