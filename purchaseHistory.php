<?php
    include('header-customer_Cart,Check&Profile.php');
    
?>
<!DOCTYPE html>
<html>
<body>
    <div class="d-flex align-items-center">
        <a href="profile.php"><img src="./assets/blog/Arrow_Right_XL.png" alt="back_button"></a>
        <h4 style="color:#6CAE7F;">Purchase History</h4>
    </div>
<div class="my-5">

    <?php
        // PUT SQL HERE
    ?>
        <div class="container-fluid ph_item w-50 p-3 rounded">
            <form action="" class="d-flex align-items-center justify-content-between">
                <img src="./assets/blog/blog1.jpg" alt="">
                <div class="ml-5 d-flex flex-column">
                    <h5>Product Name</h5>
                    <b>Price:500php</b>
                    <b>Total Price:1,500 PHP</b>
                </div>
                <div class="ml-5 d-flex flex-column">
                    <b class="mb-5">QTY: 3</b>
                    <button class="ph_sub rounded px-5 py-2" type="submit" name="submit">Buy Again</button>
                </div>
            
            </form>
        </div>

    <?php
        // PUT SQL HERE
    ?>

</div>
</body>
</html>

<?php
    include('footer.php');
?>