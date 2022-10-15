<?php
    ob_start();
    // include header.php file
    include ('partials/header.php');
?>
    <div class="main" style="height:100vh;">

<div class="container">
    <h1>UPDATE ADMIN</h1>

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

    <form action="" method="POST" class="form">
       <div>
            <label for="fName">First Name</label>
            <input type="text" name="fName" value="<?php echo $fName; ?>" required>  
       </div>
       <div>
            <label for="lName">Last Name</label>
            <input type="text" name="lName" value="<?php echo $lName; ?>" required>  
       </div>
       <div>
            <label for="uName">Username</label>
            <input type="text" name="uName" value="<?php echo $uName; ?>" required>  
       </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
       <button class="button" type="submit" name="submit">Submit</button>
   </form>
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