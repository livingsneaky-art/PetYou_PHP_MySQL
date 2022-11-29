<?php
    ob_start();
    // include header.php file
    include ('partials/header.php');
?>
  <!---main section--->
  <div class="main" style="min-height:100vh;">
        <div class="container">
            <h2>MANAGE ORDERS</h2>

            <?php

                if (isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if (isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if (isset($_SESSION['update-delivery'])){
                    echo $_SESSION['update-delivery'];
                    unset($_SESSION['update-delivery']);
                }

            ?>

            <table class="tbl-full table mt-4" style="height:auto;">
                <thead class="thead-light">
                <tr style = "text-align:center; vertical-align:middle;">
                    <th scope="col">User ID</th>
                    <th scope="col">Receipt ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Customer Email</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Order Status</th>
                    <th scope="col">Delivery Status</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col"></th>
                    <!-- <th scope="col"></th>
                    <th scope="col"></th> -->
                </tr>
                </thead>

                <tbody>

                <?php
                    //TO GET DATA
                    $sql = "SELECT * FROM cart;";
                    //CATCHER
                    $res = mysqli_query($conn, $sql);

                    if ($res == TRUE){
                        // PRESENT ROWS
                        $count = mysqli_num_rows($res);

                        if ($count > 0){
                            //Loop through data
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $customer_ID = $rows['customer_ID'];
                                $delivery = $rows['deliveryID'];
                                $customer_name = $rows['customer_name'];
                                $customer_contact_no = $rows['customer_contact_no'];
                                $customer_email = $rows['customer_email'];
                                $receipt = $rows['receiptID'];
                                $status = $rows['status'];
                                $delivery_status = $rows['delivery_status'];
                                $payment_status = $rows['payment_status'];
                                $total = $rows['total'];

                                ?>

                                <tr style = "text-align:center; vertical-align:middle;">    
                                    <td scope="row"><?php echo $customer_ID; ?></td>
                                    <td scope="row"><?php echo $receipt; ?></td>
                                    <td scope="row"><?php echo $customer_name; ?></td>
                                    <td scope="row"><?php echo $customer_contact_no; ?></td>
                                    <td scope="row"><?php echo $customer_email; ?></td>
                                    <td scope="row"><?php echo $total; ?></td>
                                    <td scope="row"><?php echo $status; ?></td>
                                    <td scope="row"><?php echo $delivery_status; ?></td>
                                    <td scope="row"><?php echo $payment_status; ?></td>
                                    <td scope="row" class="btn-st">
                                    <a href="<?php echo SITEURL; ?>admin/update.carts.php?id=<?php echo $id; ?>" ><img src="../assets/admin/edit.png" alt="Edit product" style="width: 35px;" class="mr-3"></a>
                                    <a href="<?php echo SITEURL; ?>admin/delete.carts.php?id=<?php echo $id; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $id;?>"><img src="../assets/admin/delete.png" alt="Delete product" style="width: 35px;" class="mr-3"></a>
                                    </td>
                                    
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal_<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        Are you sure you want to delete this user?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <!-- <button type="button" class="btn btn-danger">Delete</button> -->
                                            <a href="<?php echo SITEURL; ?>admin/delete.carts.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
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
                </tbody>
            </table>

        </div>
        
    </div>

<?php
    include ('partials/footer.php');
?>