<?php
    ob_start();
    // include header.php file
    include ('header-outsider.php');
?>
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
                <label for="customer_number">Contact Number</label>
                <input type="text" name="customer_number" required>  
        </div>
        <div>
                <label for="customer_email">Email Address</label>
                <input type="text" name="customer_email" required>  
        </div>
        <div>
                <label for="Address">Address</label>
                <input type="text" name="Address" required>  
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

<?php
    //TO ADD VALUES TO ADMIN TABLE

    if(isset($_POST['submit'])){

        //GET DATA FROM FORM
        $firstName = trim($_POST['first-name']);
        $lastName = trim($_POST['last-name']);
        $customer_number = trim($_POST['customer_number']);
        $customer_email = trim($_POST['customer_email']);
        $Address = trim($_POST['Address']);
        $username = trim($_POST['username']);
        $pwd = trim(md5($_POST['password']));

        $check_username = $conn->query("SELECT uName FROM admin where uName = '$username'");
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
                    $sql = "INSERT INTO user(fName, lName, customer_contact_no, customer_email, deliveryAddress, uName, password, user_type)
                    VALUES('$firstName', '$lastName', '$customer_number', '$customer_email', '$Address', '$username', '$pwd', 'Customer');";
                }

                //EXECUTING QUERY AND SAVING TO DB
                $res = $conn->query($sql) or die(mysqli_error($conn));

                //TO CHECK IF QUEY IS EXECUTED
                if ($res == TRUE){
                    $_SESSION['add'] = "<h2 class='success'>OPERATION SUCCESSFUL</h2>";
                    header("location:".SITEURL."login-page.php");
                } else {
                    $_SESSION['add'] = "<h2 class='failed'>OPERATION FAILED</h2>";
                    header("location:".SITEURL."signUp-page.php");
                }

            }
        }

      
        
    }
// include footer.php file
include ('footer.php');
?>