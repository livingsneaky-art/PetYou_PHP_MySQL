
        <div class="container">

            <?php
            if (isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
            }
            if (isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
            }
        ?>

            <?php
                //Get id to be edit
                
                $cart = $_GET['cart'];
                //SQL query to get data 
               
            ?>
            <table class="tbl-full table mt-4" style="height:auto;">
                <thead class="thead-light">
                <tr style = "text-align:center; vertical-align:middle;">
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <!-- <th scope="col"></th>
                    <th scope="col"></th> -->
                </tr>
                </thead>

                <tbody>

                <?php
                    //TO GET DATA
                    $query_product = "SELECT mt.id, mt.title, mt.description, mt.price, mb.quantity FROM product mt, product_carts mb
                    WHERE mt.id = mb.type
                    AND mb.cartID = ?;";  
                    
                    $stmt_product = $conn->prepare($query_product);
                    $stmt_product->bind_param("i", $cart);
                    $stmt_product->execute();
                    $res_product = $stmt_product->get_result();
                   
                            //Loop through data
                        while($rows_product = $res_product->fetch_assoc()){
                            $product_id = $rows_product['id'];
                            $product_title = $rows_product['title'];
                            $product_desc = $rows_product['description'];
                            $product_price = $rows_product['price'];
                            $product_qty = $rows_product['quantity'];
                            ?>

                            <tr>
                                <td><?php echo $product_title; ?></td>
                                <td><?php echo $product_desc; ?></td>
                                <td><?php echo $product_price; ?></td>
                                <td><?php echo $product_qty; ?></td>
                                <td class="btn-st">
                                    <div><a href="<?php echo SITEURL; ?>admin/delete.product.book.php?product_id=<?php echo $product_id; ?>&cart=<?php echo $cart; ?>" class="btn-red btn">Delete</a></div>
                                </td>
                            </tr>

                            <?php
                            }
                ?>
               
            </table>
        </div>
    </div>
    <?php
    include ('partials/footer.php');
?>

