<?php
    ob_start();
    // include header.php file
    include ('header.php');
?>
    <img src="./assets/Banner1.png" alt="Banner1" width="100%">




<?php

/*  include banner area  */
/*  include banner area  */

/*  include top sale section */
    //include ('Template/_top-sale.php');
/*  include top sale section */

include ('Template/_new_pets.php');

include ('Template/_avail_products.php');


/*  include special price section  */
     //include ('Template/_special-price.php');
/*  include special price section  */

/*  include banner ads  */
   // include ('Template/_banner-ads.php');
/*  include banner ads  */

/*  include new products section  */
    //include ('Template/_new-products.php');
/*  include new phones section  */

/*  include blog area  */
     //include ('Template/_blogs.php');
/*  include blog area  */

?>
</main>
</body>
<?php
    include ('footer.php');
?>