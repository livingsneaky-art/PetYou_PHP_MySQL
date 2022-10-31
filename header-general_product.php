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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

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
                <li class="nav-item">
                    <a class="nav-link" href="index.php">HOME</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="header-general_product.php">PRODUCT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutUs_general.php">ABOUT US </a>
                </li>
            </ul>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto font-rubik">
                <li >
                    
                </li>
                <li >
                    
                </li>
                <li >
                   
                </li>
            </ul>
            <ul class="navbar-nav font-rubik">
                <li class="nav-item">
                    <a class="nav-link" style="padding-right: 30px;" href="login-page.php">LOGIN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="padding-right: 30px;" href="signUp-page.php">SIGN UP</a>
                </li>
            </ul>
        </div>
        
    </nav>
    <!-- !Primary Navigation -->

</header>
<!-- !start #header -->

<!-- start #main-site -->
<main>
<div >
    <div class="container-fluid w-100 bg-white text-center d-flex justify-content-center align-items-center" style="min-height:40vh;">
        <h2 style="color: #BFD8BD;font-family: 'Montserrat', sans-serif; font-weight: 900; font-size: 7vw; color: #BFD8BD; text-shadow: 4px 4px 4px #000; "><a style="text-decoration: none; color: #BFD8BD;" href="header-general_product.php">PRODUCTS</a></h2>
    </div>
    <div style="padding-left: 250px; padding-top: 50px;">
        <input  type="text" name="search_text" id="search_text" placeholder="Search"  />
    </div>
    
    <div id="result1"></div>
    <div style="clear:both"></div>
        
	
</main>
</body>
</html>
<script>
$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"fetch-general.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result1').html(data);
			}
		});
	}
	
	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();			
		}
	});
});
</script>
<?php
    include ('footer.php');
?>