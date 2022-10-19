<?php
    ob_start();
    // include header.php file
    // include ('header-outsider.php');
    include('./configs/constants.php');
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
        <div class="p-3 text-center login_petyou" ><a style="text-decoration: none; color: #BFD8BD;" href="index.php">PETYOU</a></div>
            <div class="mt-4 container border-0 card" style="width: 30rem;">
                <form class="login_card_bg container border-0  round"  method = "POST">
                    <div class="row align-items-center px-3 ">

                        <!---------- USERNAME ---------->
                        <div class="mt-4 form-group w-75 ms-5">
                            <label for="name" class="mt-2 form-label login_font fw-bold">USERNAME</label>
                            <input type="text" class="form-control border border-secondary" id="username" name="username" required>
                        </div>

                        <!---------- PASSWORD ---------->
                        <div class="mt-4 form-group w-75 ms-5">
                            <label for="name" class="mt-2 form-label fw-bold">PASSWORD</label>
                            <input type="password" class="form-control border border-secondary"  id="upassword" name="password" required>
                        </div>

                        <!---------- LOGIN BUTTON ---------->
                        <div class="mt-3 text-center">
                            <button class="mt-3 px-3 py-2 btn btn-light fw-bold" type="submit" name="submit">LOGIN</button>
                        </div>

                        <div class>
                            <p class="mt-4 text-center fs-6">Don't have an account? <a href="signUp-page.php" class="fw-bold text-dark">SIGN UP HERE</a></p>
                        </div>

                    </div>
                </form>
            </div>
    </div>
</div>
<?php
 if(isset($_POST['submit'])){

    //get data from form
    $username = $_POST['username'];
    $pass = md5($_POST['password']);

    //get data from DB
    $sql = "SELECT * FROM user
        WHERE uName = '$username'
        AND password = '$pass';";
    //execute the the query
    $res = $conn->query($sql) or die(mysqli_error($conn));
    if($row = $res->fetch_assoc()){
        $_SESSION['id'] = $row['userID'];
        $_SESSION['fName'] = $row['fName'];
        $_SESSION['user_type'] = $row['user_type'];
    }

    //execute the the query

    $count = mysqli_num_rows($res);

    if ($count == 1 && isset($_SESSION['fName'])){
        if($_SESSION['user_type'] === 'Admin'){
            $_SESSION['login'] = "<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username;
            header('location:'.SITEURL.'admin/admin.php');
        }else if($_SESSION['user_type'] === 'Customer'){
            $_SESSION['login'] = "<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username;
            header('location:'.SITEURL.'home-page.php');
        }
    } else {
        $_SESSION['login'] = "<h5 class='failed'>USERNAME OR PASSWORD DID NOT MATCH</h5>";
        header("location:".SITEURL."login-page.php");
    }
}else {
    session_unset();
    session_destroy();
}
// include footer.php file
include ('footer.php');
?>


   
</body>
</html>