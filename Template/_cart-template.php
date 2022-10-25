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
                $id = $_SESSION['id'];
                $sql = "SELECT * FROM product p, bridge b WHERE p.productID = b.productID AND b.userID = $id"; 
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
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
                        <div class="d-flex">
                            <div class="rating text-warning font-size-12">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                            <a href="#" class="px-2 font-rale font-size-14">20,534 ratings</a>
                        </div>
                        <!--  !product rating-->

                        <!-- product qty -->
                        <div class="qty d-flex pt-2">
                            <div class="d-flex font-rale w-15">
                                <button class="qty-up border-0 bg-white" data-id="<?php echo $row['productID'] ?? '0'; ?>"><img src="./assets/blog/plus.png" alt="plus Cart"></button> 
                                <input type="text" data-id="<?php echo $row['productID'] ?? '0'; ?>" class="qty_input border px-3 w-50 bg-white text-center" disabled value="1" placeholder="1">
                                <button data-id="<?php echo $row['productID'] ?? '0'; ?>" class="qty-down border-0 bg-white"> <img src="./assets/blog/minus.png" alt="minus Cart"></button> 
                            </div>

                            <form method="post">
                                <input type="hidden" value="<?php echo $row['productID'] ?? 0; ?>" name="productID">
                                <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger px-3 border bg-white">Delete</button>
                            </form>
                            
                        </div>
                        <br>
                        <div class="border">
                        
                        </div>
                        <div style="padding-top: 10px;" class="font-size-20 text-danger font-baloo">
                            Subtotal: ₱<span class="product_price" data-id="<?php echo $row['productID'] ?? '0'; ?>"><?php echo $row['price'] ?? 0; ?></span>
                        </div>
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
                <h5 class="font-baloo font-size-20">Subtotal ( <?php echo isset($subTotal) ? $count : 0; ?> item):&nbsp; <span class="text-danger">₱<span class="text-danger" id="deal-price"><?php echo isset($subTotal) ? $subTotal : 0; ?></span> </span> </h5>
                <button type="submit" class="btn btn-warning mt-3">Checkout</button>
            </div>
        </div>
    </div>
</section>


