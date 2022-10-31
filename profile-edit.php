<?php
    ob_start();
    // include header.php file
    include ('header-customer_Cart,Check&Profile.php');
?>         
<link rel="stylesheet" type="text/css" href="css/profile.css">

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
                        <input type="text" name="fName" value="<?php echo  $fName;?>" disabled>  
                </div>
                <div>
                        <b><label for="lName">Last Name:</label></b><br>
                        <input type="text" name="lName" value="<?php echo $lName; ?>" disabled>  
                </div>
                <div>
                    <b><label for="email">Email:</label></b><br>
                        <input type="text" name="email" value="<?php echo $email; ?>" disabled>  
                </div>
                <div>
                        <b><label for="phone">Phone Number:</label></b><br>
                        <input type="text" name="phone" value="<?php echo $phone; ?>" disabled>  
                </div>
                <div>
                        <b><label for="address">Address:</label></b><br>
                        <input type="text" name="address" value="<?php echo $address; ?>" disabled>  
                </div>
                    
            
        </div>
        
    </div>
    <div style="padding-left: 1100px; padding-top: 100px" >
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <a href="profile-save.php"style="background-color: #98C9A380; color: white; text-decoration: none;" class="btn border" type="submit" name="submit">Edit Profile</a>
    </div>
    
</div>
</form>
<?php
    include ('footer.php');
?>