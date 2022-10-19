
<!-- Blogs -->
<section id="top-sale">
<div class="container py-3 px-5 home">
        <p class="htitle">NEW PETS</p>
        <!-- owl carousel -->
        <div class="owl-carousel owl-theme">
            <?php foreach ($product_shuffle as $item) { ?>
            <div class="item py-2 mr-5">
                <div class="product font-rale">
                    <a href="<?php printf('%s?productID=%s', 'product.php',  $item['productID']); ?>"><img src="<?php echo SITEURL; ?>images/product/<?php echo $item['image']; ?>" alt="" class="img-fluid"></a>
                    <div class="text-center">
                        <h6><?php echo  $item['description'] ?? "Unknown";  ?></h6>
                    </div>
                </div>
            </div>
            <?php } // closing foreach function ?>
        </div>
        <!-- !owl carousel -->
    </div>
    <!-----<div class="container py-3 home">
        <p class="htitle">NEW PETS</p>
        <hr>

        <div class="owl-carousel owl-theme" style="display: flex; align-items:center;">
            <div class="item">
                <div class="card border-0 font-rale mr-5" style="width: 18rem; background-color: #98C9A3;">
                    <h5 class="card-title font-size-16">Upcoming Products</h5>
                    <img src="./assets/blog/blog1.jpg" alt="cart image" class="card-img-top">
                    <p class="card-text font-size-14 text-black-50 py-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis non iste sequi cupiditate tempora iure. Velit accusamus saepe harum sed.</p>
                    <a href="#" class="color-second text-left">Go somewhere</a>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 font-rale mr-5" style="width: 18rem; background-color: #98C9A3;">
                    <h5 class="card-title font-size-16">Upcoming Products</h5>
                    <img src="./assets/blog/blog2.jpg" alt="cart image" class="card-img-top">
                    <p class="card-text font-size-14 text-black-50 py-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis non iste sequi cupiditate tempora iure. Velit accusamus saepe harum sed.</p>
                    <a href="#" class="color-second text-left">Go somewhere</a>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 font-rale mr-5" style="width: 18rem; background-color: #98C9A3;">
                    <h5 class="card-title font-size-16">Upcoming Products</h5>
                    <img src="./assets/blog/blog3.jpg" alt="cart image" class="card-img-top">
                    <p class="card-text font-size-14 text-black-50 py-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis non iste sequi cupiditate tempora iure. Velit accusamus saepe harum sed.</p>
                    <a href="#" class="color-second text-left">Go somewhere</a>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 font-rale mr-5" style="width: 18rem; background-color: #98C9A3;">
                    <h5 class="card-title font-size-16">Upcoming Products</h5>
                    <img src="./assets/blog/blog3.jpg" alt="cart image" class="card-img-top">
                    <p class="card-text font-size-14 text-black-50 py-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis non iste sequi cupiditate tempora iure. Velit accusamus saepe harum sed.</p>
                    <a href="#" class="color-second text-left">Go somewhere</a>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 font-rale mr-5" style="width: 18rem; background-color: #98C9A3;">
                    <h5 class="card-title font-size-16">Upcoming Products</h5>
                    <img src="./assets/blog/blog3.jpg" alt="cart image" class="card-img-top">
                    <p class="card-text font-size-14 text-black-50 py-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis non iste sequi cupiditate tempora iure. Velit accusamus saepe harum sed.</p>
                    <a href="#" class="color-second text-left">Go somewhere</a>
                </div>
            </div>
            <div class="item">
                <div class="card border-0 font-rale mr-5" style="width: 18rem; background-color: #98C9A3;">
                    <h5 class="card-title font-size-16">Upcoming Products</h5>
                    <img src="./assets/blog/blog3.jpg" alt="cart image" class="card-img-top">
                    <p class="card-text font-size-14 text-black-50 py-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis non iste sequi cupiditate tempora iure. Velit accusamus saepe harum sed.</p>
                    <a href="#" class="color-second text-left">Go somewhere</a>
                </div>
            </div>
        </div>
    </div> --->
</section>
<!-- !Blogs -->
