<?php
    ob_start();
    // include header.php file
    include ('header-outsider.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
</head>
<body>
 
<div class="main container-wrapper">
    <div class="container ">
        <!---------- CARD FOR FORM ----------> 
        <div class="p-3 text-center login_petyou">PETYOU</div>

            <div class="mt-4 container border-0 card" style="width: 32rem;">
                <form class="login_card_bg container border-0  round"  method = "POST">
                    <div class="row align-items-center px-3 ">

                        <!---------- NAME ---------->
                        <div class="mt-4 row align-items-center">
                            <!---------- FIRST NAME ---------->
                            <div class="col-md-6">
                                <label for="name" class="mt-2 form-label login_font fw-bold">FIRST NAME</label>
                                <input type="text" class="form-control border border-secondary" id="firstName" name="firstName" required>
                            </div>
                            <!---------- LAST NAME ---------->
                            <div class="col-md-6">
                                <label for="name" class="mt-2 form-label login_font fw-bold">LAST NAME</label>
                                <input type="text" class="form-control border border-secondary" id="lastName" name="lastName" required>
                            </div>
                        </div>

                        <!---------- CONTACT NUMBER ---------->
                        <div class="mt-4 col ">
                            <label for="name" class="mt-2 form-label fw-bold">CONTACT NUMBER</label>
                            <input type="password" class="form-control border border-secondary"  id="contactNum" name="contactNum" required>
                        </div>

                        <!---------- PASSWORD ---------->
                        <div class="mt-4 ">
                            <label for="name" class="mt-2 form-label fw-bold">PASSWORD</label>
                            <input type="password" class="form-control border border-secondary"  id="upassword" name="password" required>
                        </div>

                        <!---------- LOGIN BUTTON ---------->
                        <div class="mt-3 text-center">
                            <button class="mt-3 px-3 py-2 btn btn-light fw-bold">LOGIN</button>
                        </div>

                        <div class>
                            <p class="mt-4 text-center fs-6">Don't have an account? <a href="signUp-page.php" class="fw-bold text-dark">SIGN UP HERE</a></p>
                        </div>

                    </div>
                </form>
            </div>
    </div>
</div>


    <!-- <form action="" method="POST" class="form">
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
    </form> -->

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