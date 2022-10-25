<?php
    include('./configs/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetYou</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    <!-- Custom CSS file -->
    <link rel="stylesheet" href="style.css">

    <?php
    // require functions.php file
    require ('functions.php');
    ?>

</head>
<body id="main-site">

<!-- start #header -->
<header id="header">

    <!-- Primary Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark color-second-bg">
    <ul class="navbar-nav m-auto font-rubik" style="padding-left: 60px;">
                <li class="nav-item active">
                    <a class="nav-link" href="home-page.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="header-customer_product.php">PRODUCT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutUs_customer.php">ABOUT US </a>
                </li>
            </ul>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto font-rubik">
                <li>

                </li>
                <li >

                </li>
                <li>

                </li>
            </ul>
            <a style="text-decoration: none; color: black; padding-right: 30px; font-weight: bold;" class='btn btn-warmomg' href='payment.php'>Check your order</a>
            <form style="padding-right: 30px;" action="#" class="font-size-14 font-rale">
                <a href="cart.php" class="py-2 rounded-pill color-primary-bg">
                    <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
                    <span class="px-3 py-2 rounded-pill text-dark bg-light"><?php echo count($product->getData('bridge')); ?></span>
                </a>
            </form>
            <div>
                <a style="text-decoration: none; color: black; padding-right: 30px; font-weight: bold;" href="<?php echo SITEURL; ?>profile.php">PROFILE</a>
            </div>
            <div>
                <a style="text-decoration: none; color: black; font-weight: bold; padding-right: 30px;" href="<?php echo SITEURL; ?>logout.php">LOGOUT</a>
            </div>
        </div>
    </nav>
    <!-- !Primary Navigation -->

</header>
<!-- !start #header -->

<!-- start #main-site -->
<main>