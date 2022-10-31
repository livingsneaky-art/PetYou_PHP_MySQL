<!--   product  -->
<?php
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['top_sale_submit'])){
            // call method addToCart
            $Cart->addToCart($_SESSION['id'], $_POST['productID']);
        }
    }
          

    $item_id = $_GET['productID'] ?? 1;
    foreach ($product->getData() as $item) :
        if ($item['productID'] == $item_id) :

          
           
?>
<section id="product" class="py-3"> 
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <img src="<?php echo SITEURL; ?>images/product/<?php echo $item['image']; ?>" alt=""  class="img-fluid">
                    <div class="form-row pt-4 font-size-16 font-baloo">
                        <div class="col">
                            
                        <form action="" method="POST">  
                        <input type="hidden" name="productID" value="<?php echo $item['productID'] ?? '1'; ?>">
                            <?php
                            $id = $item['productID'];
                                if (in_array($item['productID'], $Cart->getCartId($product->getData('bridge')) ?? []) ){
                            
                                    $sql = "SELECT * FROM bridge WHERE productID = '$id' AND userID = '$_SESSION[id]'";
                                    $res = $conn->query($sql);
                                    $count = mysqli_num_rows($res);
                                    if($count == 0){
                                        echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-16 form-control">Add to Cart</button>';
                                    }else{
                                        echo '<button type="submit" disabled class="btn btn-success font-size-16 form-control">In the Cart</button>';
                                    }
                                }else{
                                    echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-16 form-control">Add to Cart</button>';
                                }
                            ?>
                        </form> 
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 py-5">
                    <h5 class="font-baloo font-size-20"><?php echo $item['title'] ?? "Unknown"; ?></h5>
                    <!---    product price       -->
                    <table class="my-3">
                        <tr class="font-rale font-size-14">
                            <td>Price: </td>
                            <td class="font-size-20 text-danger">₱<span><?php echo $item['price'] ?? 0; ?></span></td>
                        </tr>
                    </table>
                    <!---    !product price       -->


                    <div id="order-details" class="font-rale d-flex flex-column text-dark">
                        <small>Sold by <a href="#" style="text-decoration: none">LKR </a></small>
                    </div>
                    <hr>

                
                </div>
                <div class="col-12">
                    <h6 class="font-rubik">Product Description</h6>
                    <?php echo $item['description'] ?? "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat inventore vero numquam error est ipsa, consequuntur temporibus debitis nobis sit, delectus officia ducimus dolorum sed corrupti. Sapiente optio sunt provident, accusantium eligendi eius reiciendis animi? Laboriosam, optio qui? Numquam, quo fuga. Maiores minus, accusantium velit numquam a aliquam vitae vel?"; ?>
                </div>
            </div> 
        </div>
    
</section>
<!--   !product  -->

<?php
    endif;
    endforeach;
?>
