<!-- Top Sale -->
<?php

    shuffle($product_shuffle);

    
?>
<section id="top-sale">
    <div class="container py-3 px-5 home">
        <p class="htitle">WHAT'S NEW</p>
        <!-- owl carousel -->
        <div class="owl-carousel owl-theme">
            <?php foreach ($product_shuffle as $item) { ?>
            <div class="item py-2 mr-5">
                <div class="product font-rale">
                    <a><img src="<?php echo SITEURL; ?>images/product/<?php echo $item['image']; ?>" alt="" class="img-fluid"></a>
                    <div class="text-center">
                        <h6><?php echo  $item['title'] ?? "Unknown";  ?></h6>
                        <div class="rating text-warning font-size-12">
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                        </div>
                        <div class="price py-2">
                            <span>$<?php echo $item['price'] ?? '0' ; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php } // closing foreach function ?>
        </div>
        <!-- !owl carousel -->
    </div>
</section>
<!-- !Top Sale -->