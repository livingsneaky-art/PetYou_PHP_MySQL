<?php
    ob_start();
    // include header.php file
    include('./configs/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
</head>
<body>
 
<div class="main login-bg container-wrapper">
    <div class="container ">
        <!---------- CARD FOR FORM ----------> 
        <div class="p-3 text-center login_petyou"><a style="text-decoration: none; color: #BFD8BD;" href="index.php">PETYOU</a></div>
        <?php
            if (isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

            <form action="" method="POST" class="form">
                <!---------- NAME ---------->
                <div class="mt-4 row align-items-center">
                    <!---------- FIRST NAME ---------->
                    <div class="col-md-6">
                        <label for="first-name" class="mt-2 form-label login_font fw-bold">FIRST NAME</label>
                        <input type="text" class="form-control border border-secondary" id="first-name" name="first-name" required>
                    </div>
                    <!---------- LAST NAME ---------->
                    <div class="col-md-6">
                        <label for="last-name" class="mt-2 form-label login_font fw-bold">LAST NAME</label>
                        <input type="text" class="form-control border border-secondary" id="last-name" name="last-name" required>
                    </div>
                </div>

                <!---------- CONTACT NUMBER ---------->
                <div class="mt-4  ">
                    <label for="customer_number" class="mt-2 form-label fw-bold">CONTACT NUMBER</label>
                    <input type="text" class="form-control border border-secondary"  id="customer_number" name="customer_number" required>
                </div>
                <!---------- CUSTOMER EMAIL ---------->
                <div class="mt-4  ">
                    <label for="customer_email" class="mt-2 form-label fw-bold">CUSTOMER EMAIL</label>
                    <input type="text" class="form-control border border-secondary"  id="customer_email" name="customer_email" required>
                </div>
                <!---------- ADDRESS---------->
                <div class="mt-4 ">
                    <label for="Address" class="mt-2 form-label fw-bold">ADDRESS</label>
                    <input type="text" class="form-control border border-secondary"  id="Address" name="Address" required>
                </div>

                <!---------- USERNAME ---------->
                <div class="mt-4 ">
                    <label for="username" class="mt-2 form-label fw-bold">USERNAME</label>
                    <input type="text" class="form-control border border-secondary"  id="username" name="username" required>
                </div>

                <!---------- PASSWORD ---------->
                <div class="mt-4 ">
                    <label for="password" class="mt-2 form-label fw-bold">PASSWORD</label>
                    <input type="password" class="form-control border border-secondary"  id="password" name="password" required>
                </div>

                <!---------- LOGIN BUTTON ---------->
                <div class="mt-3 text-center">
                    <button class="mt-3 px-3 py-2 btn btn-light fw-bold" type="submit" name="submit">SIGN UP</button>
                </div>
            </form>

            <div class>
                <p class="mt-4 text-center fs-6">Already have an account? <a href="login-page.php" class="fw-bold text-dark">LOGIN HERE</a></p>
            </div>
        </div>
    </div

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
                    $_SESSION['add'] = "<center><h2 class='success'>SIGN UP SUCCESSFUL</h2></center>";
                    header("location:".SITEURL."signUp-page.php");
                } else {
                    $_SESSION['add'] = "<center><h2 class='failed'>SIGN UP FAILED</h2></center>";
                    header("location:".SITEURL."signUp-page.php");
                }

            }
        }

      
        
    }

?>

 <?php
 // include footer.php file
 include ('footer.php');
?> 


</body>
</html>