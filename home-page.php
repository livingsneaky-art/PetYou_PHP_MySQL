<?php
    ob_start();
    // include header.php file
    include ('header-customer.php');
?>

<?php

/*  include banner area  */
    include ('Template/_banner-area.php');
/*  include banner area  */

/*  include new pets section  */
    include ('Template/_new_pets.php');
/*  include new pets section  */

/*  include available product section */
    include ('Template/_avail_products.php');
/*  include available product section */
?>

</main>
</body>

<?php
    include ('footer.php');
?>