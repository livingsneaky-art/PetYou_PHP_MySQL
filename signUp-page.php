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
    <title>Sign Up</title>
</head>
<body>
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
</body>
</html>

<!-- Section: Design Block -->
<center>
    <section class="h-100">
    
        <div class="px-4 py-5 px-md-5 text-center text-lg-start h-100 login-bg" style="background-color: hsl(0, 0%, 96%)">
            <center>
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <!--<a style="text-decoration: none; color: #BFD8BD;" class="login_petyou" href="index.php">PETYOU</a>-->
                    <h1 class="login_petyou"> PETYOU</h1>
                </div>
            </center>
            <div class="container ">
                
                <div class="row gx-lg-5 align-items-center">
                
                    <!---------- CARD FOR FORM ----------> 
                    
                    <?php
                        if (isset($_SESSION['add'])){
                           echo $_SESSION['add'];
                           unset($_SESSION['add']);
                        }
                    ?>
                    <!-- CARD FORM -->
                    <center>
                        <div class="col-lg-6 mb-5 mb-lg-0  py-md-3" style="width:30rem;">
                            <div class="card round">
                                <div class="card-body py-4 px-md-5  login_card_bg round">
                                
                                    <form action="" method="POST">
                                        <!---------- NAME ---------->
                                        <div class="row">
                                            <!---------- FIRST NAME ---------->
                                            <div class="col-md-6 mb-2">
                                                <div class="form-outline">
                                                    <label for="first-name" class="form-label text-uppercase fw-bold">FIRST NAME</label>
                                                    <input type="text" id="form3Example1"  class="form-control" id="first-name" name="first-name" required>
                                                </div>
                                            </div>
                                            <!---------- LAST NAME ---------->
                                            <div class="col-md-6 mb-2">
                                                <div class="form-outline">
                                                    <label for="last-name" class="form-label text-uppercase fw-bold">LAST NAME</label>
                                                    <input type="text" id="form3Example2" class="form-control" id="last-name" name="last-name" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!---------- CONTACT NUMBER ---------->
                                        <div class="mt-4  ">
                                            <label for="customer_number" class="form-label text-uppercase fw-bold loginfont">CONTACT NUMBER</label>
                                            <input type="text" id="form3Example3" class="form-control"  id="customer_number" name="customer_number" required>
                                        </div>
                                        <!---------- CUSTOMER EMAIL ---------->
                                        <div class="mt-4  ">
                                            <label for="customer_email" class="form-label text-uppercase fw-bold">CUSTOMER EMAIL</label>
                                            <input type="text" id="form3Example3" class="form-control"  id="customer_email" name="customer_email" required>
                                        </div>
                                        <!---------- ADDRESS---------->
                                        <div class="mt-4 ">
                                            <label for="Address" class="form-label text-uppercase fw-bold">ADDRESS</label>
                                            <input type="text" id="form3Example3" class="form-control"  id="Address" name="Address" required>
                                        </div>

                                        <!---------- USERNAME ---------->
                                        <div class="mt-4 ">
                                            <label for="username" class="form-label text-uppercase fw-bold">USERNAME</label>
                                            <input type="text" id="form3Example3" class="form-control"  id="username" name="username" required>
                                        </div>

                                        <!---------- PASSWORD ---------->
                                        <div class="mt-4 ">
                                            <label for="password" class="form-label text-uppercase fw-bold">PASSWORD</label>
                                            <input type="password" id="form3Example4" class="form-control"  id="password" name="password" required>
                                        </div>

                                        <!---------- LOGIN BUTTON ---------->
                                        <div class="mt-3 text-center">
                                            <button class="btn btn-light fw-bold btn-block mb-4" type="submit" name="submit">SIGN UP</button>
                                        </div>
                                        <div class="text-center">
                                            <p>Already have an account? <a href="login-page.php" class="fw-bold text-dark text-decoration-none">LOGIN HERE</a></p>
                                        </div>
                                    </form>
                                
                                </div>     
                            </div>
                        </div> 
                    </center>
                </div>
            </div>
        </div>        
    </section>
</center>
<?php
    //TO ADD VALUES TO USER TABLE

    if(isset($_POST['submit'])){

        //GET DATA FROM FORM
        $firstName = trim($_POST['first-name']);
        $lastName = trim($_POST['last-name']);
        $customer_number = trim($_POST['customer_number']);
        $customer_email = trim($_POST['customer_email']);
        $Address = trim($_POST['Address']);
        $username = trim($_POST['username']);
        $pwd = trim(md5($_POST['password']));

        $check_username = $conn->query("SELECT uName FROM user where uName = '$username'");
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
