<?php
    include ('header-customer_Cart,Check&Profile.php');
    
?>
<section>
<div class="d-flex align-items-center">
        <a href="profile-edit.php"><img src="./assets/blog/Arrow_Right_XL.png" alt="back_button"></a>
        <h4 style="color:#6CAE7F;">Purchase History</h4>
    </div>
<div class="my-5">

    <?php
    $custEmail = $_SESSION['customer_email'];
        $sql = "SELECT * FROM  cart c, product_carts pc, product p, payment_details pd  WHERE c.customer_email = '$custEmail' AND pc.type = p.productID AND c.receiptID = pd.id AND c.id = pc.cartID";
        $res = $conn->query($sql) or die(mysqli_error($conn));
        $count = mysqli_num_rows($res);
        if($count > 0){
            while($row = $res->fetch_assoc()){
                //if(isset($row['cardID'])){

                
         
    ?>
        <div class="container-fluid ph_item w-50 p-3 rounded">
            <form action="" class="d-flex align-items-center justify-content-between">
            <img src="<?php echo SITEURL; ?>images/product/<?php echo $row['image']; ?>" alt="" class="round" style="width: 12vh; height: 10vh;">
                <div class="ml-5 d-flex flex-column">
                    <h5><?php echo $row['title']?></h5>
                    <b><?php echo $row['price']?></b>
                    <b>Total Price: <?php echo $row['total']?></b>
                </div>
                <div class="ml-5 d-flex flex-column">
                    <b class="mb-5">QTY: <?php echo $row['quantity']?></b>
                    <button class="ph_sub rounded px-5 py-2" type="submit" name="submit">Buy Again</button>
                </div>
            
            </form>
        </div>
    <br>
        

    <?php
   // }
           }
        }else{
            ?>
                 <section id="cart" class="py-3 mb-5">
                    <div class="container-fluid w-75">
                        <!--  shopping cart items   -->
                        <div class="row">
                            <div class="col">
                                <!-- Empty Cart -->
                                    <div class="row py-3 mt-3">
                                        <div class="col-sm-12 text-center py-2">
                                            <img src="./assets/blog/empty_cart.png" alt="Empty Cart" class="img-fluid" style="height: 200px;">
                                            <p class="font-baloo font-size-16 text-black-50">Empty History</p>
                                        </div>
                                    </div>
                                <!-- .Empty Cart -->
                            </div>
                        </div>
                    </div>
                    <div>
                        <center>
                            <a href="home-page.php" class="btn btn-warning">Continue Shopping</a>   
                        </center> 
                    </div>
                    <div style="padding-top:80px;">

                    </div>
                </section>
            <?php
        }
    ?>

</div>
</section>

<?php
    include('footer.php');
?>
