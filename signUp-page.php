<?php
    ob_start();
    // include header.php file
    // include ('header-outsider.php');
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
</body>
</html>


<!-- Section: Design Block -->
<section class="h-100 ">
  
  <div class="px-4 py-5 px-md-5 text-center text-lg-start h-100 login-bg" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0 ">
            <h1 class="login_petyou"> PETYOU</h1>
        </div>

        <!-- CARD FORM -->
        <div class="col-lg-6 mb-5 mb-lg-0  py-md-3" style="width:30rem;">
          <div class="card round">
            <div class="card-body py-4 px-md-5  login_card_bg round">
              <form>

                <!-- NAME -->
                <div class="row">
                  <div class="col-md-6 mb-2">
                    <div class="form-outline">
                        <label class="form-label text-uppercase fw-bold" for="form3Example1">First name</label>
                        <input type="text" id="form3Example1" class="form-control" />
                    </div>
                  </div>
                  <div class="col-md-6 mb-2">
                    <div class="form-outline">
                      <label class="form-label text-uppercase fw-bold" for="form3Example2">Last name</label>
                      <input type="text" id="form3Example2" class="form-control" />
                    </div>
                  </div>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-2">
                    <label class="form-label text-uppercase fw-bold loginfont" for="form3Example3">Contact Number</label>
                  <input type="email" id="form3Example3" class="form-control" />
                </div>

                <!-- Email input -->
                <div class="form-outline mb-2">
                    <label class="form-label text-uppercase fw-bold" for="form3Example3">Address</label>
                    <input type="email" id="form3Example3" class="form-control" />
                </div>

                <!-- Email input -->
                <div class="form-outline mb-2">
                    <label class="form-label text-uppercase fw-bold" for="form3Example3">Email</label>
                    <input type="email" id="form3Example3" class="form-control" />
                </div>

                <!-- Email input -->
                <div class="form-outline mb-2">
                    <label class="form-label text-uppercase fw-bold for="form3Example3">Username</label>
                    <input type="email" id="form3Example3" class="form-control" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-2">
                    <label class="form-label text-uppercase fw-bold" for="form3Example4">Password</label>
                  <input type="password" id="form3Example4" class="form-control" />
                </div>

                <!-- Submit button -->
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-light fw-bold btn-block mb-4">Sign up</button>
                </div>

                <!-- Register buttons -->
                <div class="text-center">
                  <p>Already have an account? <a href="login-page.php" class="fw-bold text-dark text-decoration-none">LOGIN HERE </a></p>
                  
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  
   

</section>
<!-- Section: Design Block -->


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

?>

 <?php
 // include footer.php file
 include ('footer.php');
?> 


</body>
</html>