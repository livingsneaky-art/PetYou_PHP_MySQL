<!-- Shopping cart section  -->
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['delete-cart-submit'])){
            $deletedrecord = $Cart->deleteCart($_POST['productID']);
        }
    }
?>
<section id="cart" class="py-3 mb-5">
    
    <div class="container-fluid w-75">
        <div class="container-fluid w-100 text-center d-flex justify-content-center align-items-center" style="min-height:40vh;">
            <h2 style="color: #BFD8BD;font-family: 'Montserrat', sans-serif; font-weight: 900; font-size: 5vw; color: #BFD8BD; text-shadow: 4px 4px 4px #000;">SHOPPING CART</h2>
        </div>

        <!--  shopping cart items   -->
        <div class="row">
            <?php
                $subTotal = 0;
                $quantity = 0;
                $qty=0;
                $id = $_SESSION['id'];
                $sql = "SELECT * FROM product p, bridge b WHERE p.productID = b.productID AND b.userID = $id"; 
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
            
                if($count == 0){
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
                                            <p class="font-baloo font-size-16 text-black-50">Empty Cart</p>
                                        </div>
                                    </div>
                                <!-- .Empty Cart -->
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                }
                
                $_SESSION['count'] = $count;
                while($row = $res->fetch_assoc()){
                    
                    
            ?>
            <div class="col-sm-5 card m-2" style="background-color:#98C9A3;"> 
                
            
                <!-- cart item -->
                <div class="row py-3 mt-3">
                    <div class="col-sm-5">
                        <img src="<?php echo SITEURL; ?>images/product/<?php echo $row['image']; ?>" alt="" style="height: auto; min-width:10vw;" class="img-fluid">
                    </div>
                    <div class="col-sm-6">
                        <h5 class="font-baloo font-size-20"><?php echo $row['title'] ?? "Unknown"; ?></h5>
                        
                        <div class="font-size-20 text-danger font-baloo">
                            ₱<span class="product_price" ><?php echo $row['price'] ?? 0; ?></span>
                        </div>
                       
                        <small>by <?php echo $item ?? "LKR"; ?></small>
                        <!-- product rating -->
                        
                        <!--  !product rating-->

                        <!-- product qty -->
                        <div class="qty d-flex pt-2">
                                
                            <form method="post">
                                <input type="hidden" value="<?php echo $row['productID'] ?? 0; ?>" name="productID">
                                <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger px-3 border bg-white">Delete</button>
                            </form>   
                            
                        </div>
                        <br>
                        
                       
                    </div> 
                </div>
            </div>
            <?php 
                $subTotal += ($row['price'] );
                }
            ?>
        </div>
        
    </div>
    
    <!-- subtotal section-->
    <div class="container-fluid w-100 px-0 sticky_lej" style="background-color: #FFFFE9;">
        <div class="sub-total border text-center mt-2">
            <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i>Your order is eligible for FREE Delivery.</h6>
            <div class="border-top py-4">
                <h5 class="font-baloo font-size-20">Subtotal ( <?php echo isset($subTotal) ? $count : 0; ?> item):&nbsp; <span class="text-danger">₱<span class="text-danger" id="deal-price"><?php echo isset($subTotal) ? $subTotal : 0;?></span> </span> </h5>
                <form action="payment.php">
                    <button type="submit" name="submit" class="btn btn-warning mt-3">Proceed to Checkout</button>
                </form>
                
            </div>
        </div>
    </div>
    
</section>



