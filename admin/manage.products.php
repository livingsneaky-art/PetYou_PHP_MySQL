<?php
    ob_start();
    // include header.php file
    include ('partials/header.php');
?>
 <!---main section--->
 <div class="main" style="height:100%; padding-bottom:15em;">
        <div class="container">
            <h2>MANAGE PRODUCTS</h2>
            <?php
                if (isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if (isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if (isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if (isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if (isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>
           
            <a href="add.product.php" class="button shadow "><i class="fa fa-plus" aria-hidden="true"></i>ADD PRODUCTS</a>
            <table class="tbl-full table mt-4">
                <thead class="thead-light">
                <tr class="text-center">
                    <th class="p-3">Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>         
                    <th></th>                              
                </tr>
                </thead>

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
                              
                            <tr class="text-center align-middle">
                                <td class="p-5"><img src="<?php echo SITEURL; ?>images/product/<?php echo $image; ?>" alt="" width="100px"></td>
                                <td class="align-middle"><?php echo $title; ?></td>
                                <td class="align-middle"><?php echo $description; ?></td>
                                <td class="align-middle"><?php echo $price; ?></td>
                                <td class="text-center align-middle" >
                                    <a href="<?php echo SITEURL; ?>admin/update.products.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" ><img src="../assets/admin/edit.png" alt="Edit product" style="width: 35px;" class="mr-3"></a>
                                    <a href="<?php echo SITEURL; ?>admin/delete.products.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $id;?>"><img src="../assets/admin/delete.png" alt="Delete product" style="width: 35px;" class="mr-3"></a>
                                </td>
                            </tr>
                                
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal_<?php echo $id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    Are you sure you want to delete <?php echo $title ?>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="<?php echo SITEURL; ?>admin/delete.products.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" class="btn btn-danger">Delete</a>
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
            </table>
        </div>
    </div>
                            
    
<?php
    include ('partials/footer.php');
?>