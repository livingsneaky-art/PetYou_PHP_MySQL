<?php
    ob_start();
    // include header.php file
    include ('header-customer_aboutUs.php');
?>       
  
<?php 
    /*  include banner area  */
    include ('Template/_banner-area.php');
/*  include banner area  */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        center {
            background-color: #FFFFE9;
            padding: 50px; 
        }

        .center {
            margin: auto;
            width: 100%;
            background-color: rgb(152, 201, 163, 0.7);
            padding: 30px;
            text-align: center;
            border-radius: 20px;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
</head>
<body>
    <center>
    <div class="container">
        <div class="center">
                <h1>About Us</h1>
            <h3>
            Lorem ipsum dolor sit amet. Sed Quis ipsa non recusandae laudantium qui voluptas obcaecati. Cum voluptatem eligendi ut asperiores rerum non dolor itaque in deleniti labore. <br><br> Ut repudiandae cupiditate est maxime quis et expedita vero et maxime aspernatur ut sapiente minima et nostrum delectus. Qui quia nemo id tempora velit aut autem molestiae id ipsum beatae id accusantium optio ut nisi sint a expedita neque.
            <br>
            Ut repudiandae cupiditate est maxime quis et expedita vero et maxime aspernatur ut sapiente minima et nostrum delectus. Qui quia nemo id tempora velit aut autem molestiae id ipsum beatae id accusantium optio ut nisi sint a expedita neque.

            </h3>
        </div>
    </div>
    </center>
</body>
</html>

<?php
    include ('footer.php');
?>