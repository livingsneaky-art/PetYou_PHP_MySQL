<!-- Top Sale -->
<?php

    shuffle($product_shuffle1);

    
?>
<section id="top-sale">
    <div class="container py-3 px-5 home">
        <p class="htitle">NEW PETS</p>
        <!-- owl carousel -->
        <div class="owl-carousel owl-theme">
            <?php foreach ($product_shuffle1 as $item) { ?>
            <div class="item py-2 mr-5">
                <div class="product font-rale">
                    <a><img src="<?php echo SITEURL; ?>images/product/<?php echo $item['image']; ?>" alt="" width="200" height="300"></a>
                    <div class="text-center">
                        <h6><?php echo  $item['petname'] ?? "Unknown";  ?></h6>
                    </div>
                </div>
            </div>
            <?php } // closing foreach function ?>
        </div>
        <!-- !owl carousel -->
    </div>
</section>
<!-- !Top Sale -->