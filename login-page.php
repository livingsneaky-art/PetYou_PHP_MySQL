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
<?php
                    if (isset($_SESSION['no-login-message'])){
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']);
                    }
                ?>
<section class="h-100">
    <div class="px-4 py-5 px-md-5 text-center text-lg-start h-100 login-bg" style="background-color: hsl(0, 0%, 96%)">
    <!-- <div class="container h-100"> -->
        <div class="d-flex h-100 align-items-center">
            <div class="w-100">
            <!---------- CARD FOR FORM ----------> 
            <div class="p-3 text-center login_petyou" >
                <a style="text-decoration: none; color: #BFD8BD; font-size: 100px;" href="index.php">PETYOU</a>
            </div>
                <div class="mt-4 border-0 card round col-6 mx-auto" style="width: 30rem;">
                    <form class="login_card_bg container round"  method = "POST">
                        <div class="row align-items-center px-3 d-flex justify-content-center ">

                            <!---------- USERNAME ---------->
                            <div class="mt-4 form-group w-75">
                                <label for="name" class="mt-2 form-label login_font fw-bold">USERNAME</label>
                                <input type="text" class="form-control border border-secondary" id="username" name="username" required>
                            </div>

                            <!---------- PASSWORD ---------->
                            <div class="mt-4 form-group w-75 ">
                                <label for="name" class="mt-2 form-label fw-bold">PASSWORD</label>
                                <input type="password" class="form-control border border-secondary"  id="upassword" name="password" required>
                            </div>

                            <!---------- LOGIN BUTTON ---------->
                            <div class="mt-3 text-center mt-4">
                                <button class="mt-3 px-3 py-2 btn btn-light fw-bold" type="submit" name="submit">LOGIN</button>
                            </div>

                            <div class="mb-3">
                                <p class="mt-4 text-center fs-6">Don't have an account? <a href="signUp-page.php" class="fw-bold text-dark">SIGN UP HERE</a></p>
                            </div>

                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </div>
</section>
<?php
$discount_id = 1;
$forDiscount = "SELECT * FROM discount WHERE discountID = $discount_id";
$discount = mysqli_query($conn, $forDiscount);
$countDiscount = mysqli_num_rows($discount);
if($countDiscount == 0){
    $sqlDiscount = "INSERT INTO discount(discountA, discountB, discountC, discountD) VALUES(10,20,30,40);";
    $resDiscount = $conn->query($sqlDiscount);
}else {
        echo " ";
}

$sql4= "SELECT * FROM type_delivery WHERE title = 'LBC'";
$res4 = mysqli_query($conn, $sql4);
$count1 = mysqli_num_rows($res4);
if($count1 == 0){
    $sql2 = "INSERT INTO type_delivery(title, image_name) VALUES('LBC', 'NULL'), ('Grab', 'NULL'), ('Lalamove', 'NULL');";
    $res2 = $conn->query($sql2);
}else{
    echo " ";
}

$sql5= "SELECT * FROM product WHERE title = 'product1'";
$res5 = mysqli_query($conn, $sql5);
$count2 = mysqli_num_rows($res5);
if($count2 == 0){
    $sql3 = "INSERT INTO `product`(`productID`, `title`, `description`, `price`, `image`) VALUES
    (1, 'product1', 'description1', 100, 'Product_.1.JPG'),
    (2, 'product2', 'description2', 200, 'Product_.2.JPG'),
    (3, 'product3', 'description3', 300, 'Product_.3.JPG'),
    (4, 'product4', 'description4', 400, 'Product_.4.JPG'),
    (5, 'product5', 'description5', 500, 'Product_.5.JPG'),
    (6, 'product6', 'description6', 600, 'Product_.6.JPG'),
    (7, 'product7', 'description7', 700, 'Product_.7.PNG'),
    (8, 'product8', 'description8', 800, 'Product_.8.PNG');"; 
    $res3 = $conn->query($sql3);
}else{
    echo " ";
}

$sql6= "SELECT * FROM pet WHERE petname = 'pet1'";
$res6 = mysqli_query($conn, $sql6);
$count3 = mysqli_num_rows($res6);
if($count3 == 0){
    $sql4 = "INSERT INTO `pet`(`petID`, `petname`, `petdescription`, `price`, `image`) VALUES
    (1, 'Pet1', 'Pet description1', 100, 'Pet_.1.jpg'),
    (2, 'Pet2', 'Pet description2', 200, 'Pet_.2.jpg'),
    (3, 'Pet3', 'Pet description3', 300, 'Pet_.3.jpg'),
    (4, 'Pet4', 'Pet description4', 400, 'Pet_.4.jpg'),
    (5, 'Pet5', 'Pet description5', 500, 'Pet_.5.jpg'),
    (6, 'Pet6', 'Pet description6', 600, 'Pet_.6.jpg'),
    (7, 'Pet7', 'Pet description7', 700, 'Pet_.7.jpg'),
    (8, 'Pet8', 'Pet description8', 800, 'Pet_.8.png')"; 
    $res4 = $conn->query($sql4);
}else{
    echo " ";
}



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
        $_SESSION['customer_email'] = $row['customer_email'];
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
        // $_SESSION['login'] = "<h5 class='failed'>USERNAME OR PASSWORD DID NOT MATCH</h5>";
        // alert
        $_SESSION['login'] =  "<script> alert('USERNAME OR PASSWORD DID NOT MATCH'); </script>";
        header("location:".SITEURL."login-page.php");
        // header('Location: "login-page.php"');
    }
}else {
    session_unset();
    session_destroy();
}
?>
<?php
// include footer.php file
include ('footer.php');
?>

</body>
</html>
   
