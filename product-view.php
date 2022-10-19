<?php
    ob_start();
    // include header.php file
    include ('header-product.php');
?>         
 <!---main section--->
 <div class="main" style="height:100%; padding-bottom:15em;">
        <div class="container">
            <h2>PRODUCTS</h2>
            
         

            <table class="tbl-full">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                </tr>
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

                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $description; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><img src="<?php echo SITEURL; ?>images/product/<?php echo $image; ?>" alt="" width="100px"></td>
                                    
                                </tr>

                            <?php
                            }
                        }
                    } else {

                    }

                ?>
            </table>
        </div>
    </div>
<?php
    include ('footer.php');
?>