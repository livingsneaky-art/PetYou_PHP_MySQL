<?php
    ob_start();
    // include header.php file
    include ('header-customer_Cart,Check&Profile.php');
?>         
<link rel="stylesheet" type="text/css" href="css/profile.css">
<div class="sidebar">
    <h1>PETYOU</h1><br><br>
    <img src="images/defaultUserImage.png" alt="...">
    <ul>
        <br><li><a href="#"><h5>Profile</h5></a></li><br>
        <li><a href="purchaseHistory.php"><h5>Purchase History</h5></a></li>
    </ul>
</div>
<div class="main" style="height:100vh;">
    <div class="container">
    
        
        <?php
            if (isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['id'])){
                $id = $_SESSION['id'];
                $sql = "SELECT * FROM user WHERE userID = $id";
                $res = $conn->query($sql) or die(mysqli_error($conn));
                if($res == TRUE){
                    $count = $res->num_rows;
                    if($count == 1){
                        $row = $res->fetch_assoc();
                        $fName = $row['fName'];
                        $lName = $row['lName'];
                        $phone = $row['customer_contact_no'];
                        $email = $row['customer_email'];
                        $address = $row['deliveryAddress'];
                    }else{
                        header('location:'.SITEURL.'login-page.php');
                    }
                }
            }
        ?>
        
        <div class="form-container">
            <form action="" method="POST">
                <div>
                        <b><label for="fName">First Name:</label></b><br>
                        <input type="text" name="fName" value="<?php echo  $fName;?>">  
                </div>
                <div>
                        <b><label for="lName">Last Name:</label></b><br>
                        <input type="text" name="lName" value="<?php echo $lName; ?>" required>  
                </div>
                <div>
                    <b><label for="email">Email:</label></b><br>
                        <input type="text" name="email" value="<?php echo $email; ?>" required>  
                </div>
                <div>
                        <b><label for="phone">Phone Number:</label></b><br>
                        <input type="text" name="phone" value="<?php echo $phone; ?>" required>  
                </div>
                <div>
                        <b><label for="address">Address:</label></b><br>
                        <input type="text" name="address" value="<?php echo $address; ?>" required>  
                </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button class="button" type="submit" name="submit">Edit Profile</button>
            </form>
        </div>
        
    </div>
</div>
<?php 
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    //SQL query to to update admin
    $sql = "UPDATE user
        SET fName = '$fName',
        lName = '$lName',
        customer_email = '$email',
        customer_contact_no = '$phone',
        deliveryAddress = '$address'
        WHERE userID = '$id';";
    
    //to execute the query
    $res = $conn->query($sql);
    
    if ($res == TRUE){
        $_SESSION['update'] = "<center><h2 class='success'>UPDATE SUCCESSFUL</h2></center>";
        header("location:".SITEURL."profile.php");
    } else {
        $_SESSION['update'] = "<center><h2 class='failed'>UPDATE FAILED</h2></center>";
        header("location:".SITEURL."profile.php");
    }
    
}

?>
<?php
    include ('footer.php');
?>