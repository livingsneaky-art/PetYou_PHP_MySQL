<?php
    ob_start();
    // include header.php file
    include ('header-customer_product.php');
?>         
 <!---main section--->
 <div class="main" style="height:100%; padding-bottom:15em;">
        <div class="container-fluid w-100 bg-white text-center d-flex justify-content-center align-items-center" style="min-height:40vh;">
            <h2 style="color: #BFD8BD;font-family: 'Montserrat', sans-serif; font-weight: 900; font-size: 7vw; color: #BFD8BD; text-shadow: 4px 4px 4px #000; ">PRODUCTS</h2>
        </div>
        <div class="container-fluid w-75">
           
            <div class="row mt-5">
                <?php
                    //TO GET DATA
                    $sql = "SELECT * FROM product;";
                    //CATCHER
                    $res = $conn->query($sql);

                    if ($res == TRUE){
                        // PRESENT ROWS
                        $count = $res->num_rows;

                        if ($count > 0){
                            //Loop through data
                            while($rows = $res->fetch_assoc()){
                                $id = $rows['productID'];
                                $title = $rows['title'];
                                $description = $rows['description'];
                                $price = $rows['price'];
                                $image = $rows['image'];

                ?>
                    <button type="button" class="p-0 m-2 btn card d-flex justify-content-center align-items-center prod_btn bg-green" style="width:15vw; background-color: #98C9A3;" data-toggle="modal" data-target="#exampleModalCenter<?php echo $id?>">
                        <img style="padding-top: 30px; height: 15vw;" src="<?php echo SITEURL; ?>images/product/<?php echo $image; ?>" alt="" width="200px">
                        <div class="text-center"> <?php echo $title; ?> </div>
                        <div class="text-center prod_price" > ₱<?php echo $price?> </div>
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $title; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php echo $description ?>
                                </div>
                                <div class="modal-footer">
                                    <!-- DIRI I BUTANG RYAN TUNG PARA ADD TO CART -->
                                </div>
                            </div>
                        </div>
                    </div>           

                <?php
                            }
                        }
                    } else {

                    }

                ?>
            </div>
            
        </div>
    </div>
<?php
    include ('footer.php');
?>