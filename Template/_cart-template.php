<!-- Shopping cart section  -->
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['delete-cart-submit'])){
            $deletedrecord = $Cart->deleteCart($_POST['productID']);
        }

        // save for later
        if (isset($_POST['wishlist-submit'])){
            $Cart->saveForLater($_POST['productID']);
        }
    }
?>


<section id="cart" class="py-3 mb-5">
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Shopping Cart</h5>
    
        <!--  shopping cart items   -->
        <div class="row">
       
            <div class="col-sm-9">
            <?php
            $subTotal = 0;
                $id = $_SESSION['id'];
                $sql = "SELECT * FROM product p, bridge b WHERE p.productID = b.productID AND b.userID = $id"; 
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                while($row = $res->fetch_assoc()){
                    
                ?>
                <!-- cart item -->
                <div class="row border-top py-3 mt-3">
                    <div class="col-sm-2">
                        <img src="<?php echo SITEURL; ?>images/product/<?php echo $row['image']; ?>" alt="" style="height: 120px;" class="img-fluid">
                    </div>
                    <div class="col-sm-8">
                        <h5 class="font-baloo font-size-20"><?php echo $row['title'] ?? "Unknown"; ?></h5>
                        <small>by <?php echo $item ?? "LRK"; ?></small>
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
                            <div class="d-flex font-rale w-25">
                                <button class="qty-up border bg-light" data-id="<?php echo $row['productID'] ?? '0'; ?>"><i class="fas fa-angle-up"></i></button>
                                <input type="text" data-id="<?php echo $row['productID'] ?? '0'; ?>" class="qty_input border px-2 w-100 bg-light" disabled value="1" placeholder="1">
                                <button data-id="<?php echo $row['productID'] ?? '0'; ?>" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
                            </div>

                            <form method="post">
                                <input type="hidden" value="<?php echo $row['productID'] ?? 0; ?>" name="productID">
                                <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger px-3 border-right">Delete</button>
                            </form>

                            <form method="post">
                                <input type="hidden" value="<?php echo $row['productID'] ?? 0; ?>" name="productID">
                                <button type="submit" name="wishlist-submit" class="btn font-baloo text-danger">Save for Later</button>
                            </form>
                        </div>
                        <!-- !product qty -->
                    </div>
                    <div class="col-sm-2 text-right">
                        <div class="font-size-20 text-danger font-baloo">
                            $<span class="product_price" data-id="<?php echo $row['productID'] ?? '0'; ?>"><?php echo $row['price'] ?? 0; ?></span>
                        </div>
                    </div>
                </div>
                <!-- !cart item -->
                <?php 
                    $subTotal += ($row['price'] );
                    }
                ?>
            </div>
            
            <!-- subtotal section-->
            <div class="col-sm-3">
                <div class="sub-total border text-center mt-2">
                    <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i> Your order is eligible for FREE Delivery.</h6>
                    <div class="border-top py-4">
                        <h5 class="font-baloo font-size-20">Subtotal ( <?php echo isset($subTotal) ? $count : 0; ?> item):&nbsp; <span class="text-danger">$<span class="text-danger" id="deal-price"><?php echo isset($subTotal) ? $subTotal : 0; ?></span> </span> </h5>
                        <button type="submit" class="btn btn-warning mt-3">Proceed to Buy</button>
                    </div>
                </div>
            </div>
            <!-- !subtotal section-->
        </div>
        <!--  !shopping cart items   -->
    </div>
</section>


