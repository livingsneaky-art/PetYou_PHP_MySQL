<!-- Top Sale -->
<?php

    shuffle($product_shuffle);

    // request method post
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['top_sale_submit'])){
            // call method addToCart
            $Cart->addToCart($_SESSION['id'], $_POST['productID']);
        }
    }
?>
<section id="top-sale">
    <div class="container py-3 px-5 home">
        <p class="htitle">AVAIL THE PRODUCTS</p>
        <!-- owl carousel -->
        <div class="owl-carousel owl-theme">
            <?php foreach ($product_shuffle as $item) { ?>
            <div class="item py-2 mr-5">
                <div class="product font-rale">
                    <a href="<?php printf('%s?productID=%s', 'product.php',  $item['productID']); ?>"><img src="<?php echo SITEURL; ?>images/product/<?php echo $item['image']; ?>" alt="" width="200" height="300"></a>
                    <div class="text-center">
                        <h6><?php echo  $item['title'] ?? "Unknown";  ?></h6>
                        <div class="price py-2">
                            <span>$<?php echo $item['price'] ?? '0' ; ?></span>
                        </div>
                        <form method="post">
                            <input type="hidden" name="productID" value="<?php echo $item['productID'] ?? '1'; ?>">
                            
                            <?php
                            $id = $item['productID'];
                            if (in_array($item['productID'], $Cart->getCartId($product->getData('bridge')) ?? []) ){
						
                                $sql = "SELECT * FROM bridge WHERE productID = '$id' AND userID = '$_SESSION[id]'";
                                $res = $conn->query($sql);
                                $count = mysqli_num_rows($res);
                                if($count == 0){
                                    echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
                                }else{
                                    echo '<button type="submit" disabled class="btn btn-success font-size-12">In the Cart</button>';
                                }
                            }else{
                                echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
                            }
                            ?>

                        </form>
                    </div>
                </div>
            </div>
            <?php } // closing foreach function ?>
        </div>
        <!-- !owl carousel -->
    </div>
</section>
<!-- !Top Sale -->