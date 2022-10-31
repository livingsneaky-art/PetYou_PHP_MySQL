<?php
    ob_start();
    // include header.php file
    include ('header-customer_Cart,Check&Profile.php');
    include('login.check.php');
?>         
<link rel="stylesheet" type="text/css" href="css/profile.css">
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
<div class="sidebar">
    <div class="container-fluid w-100 text-center d-flex justify-content-center align-items-center" style="padding-bottom: 30px;">
        <a href="home-page.php" style="color: #BFD8BD;font-family: 'Montserrat', sans-serif; font-weight: 900; font-size: 4vw; color: #BFD8BD; text-shadow: 4px 4px 4px #000; text-decoration: none;">PETYOU</a>
    </div>
   
    <ul style="padding-top: 300px;">
        <br><li><a href="profile-edit.php" class="text-success"><h5>Profile</h5></a></li><br>
        <li><a href="purchaseHistory.php"><h5>Purchase History</h5></a></li>
    </ul>
</div>
<div style="padding-left: 60px; padding-top: 130px;">
    <img src="images/defaultUserImage.png" alt="" width="300" height="300" />
    </div>
    
<div class="main" style="height:100vh;">
    <div class="container">
    
        
        
        
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
                    
            
        </div>
        
    </div>
    <div style="padding-left: 1100px; padding-top: 100px" >
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button style="background-color: #98C9A380; color: white; width: 100px;" class="btn border" type="submit" name="submit">Save</button>
    </div>
    
</div>
</form>
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
        header("location:".SITEURL."profile-save.php");
    } else {
        $_SESSION['update'] = "<center><h2 class='failed'>UPDATE FAILED</h2></center>";
        header("location:".SITEURL."profile-save.php");
    }
    
}

?>
<?php
    include ('footer.php');
?>