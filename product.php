<?php
ob_start();
    // include header.php file
    include ('header-customer.php');
    include('login.check.php');
?>

<?php

    /*  include products */
    include ('Template/_products.php');
    /*  include products */

    /*  include top sale section */
    include ('Template/_avail_products.php');
    /*  include top sale section */

?>

<?php
// include footer.php file
include ('footer.php');
?>

