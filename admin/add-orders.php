<?php
   ob_start();
    // include header.php file
    include ('partials/header.php');
?>


<div style="background-color:#F7DAD9; height:100%; padding-top:1em; padding-bottom:1em;">
    <br>
        <div class="form-container">
            <form action="" method="POST" class="form-overlay">

            <?php 

            include('edit-orders.php');

            $cart = $_GET['id'];

            if (isset($_SESSION['product'])){
                echo $_SESSION['product'];
                unset($_SESSION['product']);
            }

        ?>
            
            <a href="<?php echo SITEURL; ?>admin/update.carts.php?id=<?php echo $cart; ?>" class="btn-blue btn">Back to cart details</a>
                <!-----productS CHOICES------->
                <h2>products</h2>
                <div class="input">
                
                    <div class="grid-container">
                        
                        <?php
                            //to get data from database
                            $sql = "SELECT * FROM product;";
                            //execute the query
                            $res = mysqli_query($conn, $sql);
                            //count rows
                            $count = mysqli_num_rows($res);

                            if($count > 0){
                                while($row = mysqli_fetch_assoc($res)){
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    $image_name = $row['image'];
                                    $descritpion = $row['description'];
                                    $price = $row['price'];
                        ?>
                            <div class="center">
                                <img src="<?php echo SITEURL; ?>images/product/<?php echo $image_name; ?>" alt="" width="100px" height="200px">
                                <div>
                                    <h3><?php echo $title ?></h3>
                                    <p class="desc"><?php echo $descritpion; ?></p>
                                    <p><?php echo $price; ?></p>
                                </div>
                                <input type="checkbox" name="product[]" value="<?php echo $id; ?>">
                                <br>
                                Quantity:
                                <input type="number" name="product_qty[<?php echo $id; ?>]" min="1" max="10">
                            </div>
                            <?php 
                                }
                            }
                        ?>
                            
                    </div>
                    <input type="hidden" value="<?php echo $cart; ?>" name="cart">
                </div>

              
                <center style="margin-top: 20px;">
                   <button class="button" type="submit" name="submit" >Submit</button> 
                </center>
            </form>
        </div>
    </div>


<?php
    include('partials/footer.php');
?>