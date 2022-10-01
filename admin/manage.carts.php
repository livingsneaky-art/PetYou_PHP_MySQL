<?php
    ob_start();
    // include header.php file
    include ('partials/header.php');
?>
  <!---main section--->
  <div class="main" style="min-height:100vh;">
        <div class="container">
            <h2>MANAGE CARTS</h2>

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

            <table class="tbl-full" style="height:auto; table-layout: auto;
    width: 100%;">
                <tr>
                    <th>ID</th>
                    <th>Cart ID</th>
                    <th>Customer Name</th>
                    <th>Customer Contact Number</th>
                    <th>Customer Email</th>
                    <th>Status</th>
                    
                    <th>delivery Status</th>
                    <th>Transaction Status</th>
                   
                </tr>

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
                                $delivery = $rows['deliveryID'];
                                $customer_name = $rows['customer_name'];
                                $customer_contact_no = $rows['customer_contact_no'];
                                $customer_email = $rows['customer_email'];
                                $receipt = $rows['receiptID'];
                                $status = $rows['status'];
                                $delivery_status = $rows['delivery_status'];
                                $transaction = $rows['transaction_status'];
                                

                                ?>

                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $delivery; ?></td>
                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact_no; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td><?php echo $delivery_status; ?></td>
                                    <td><?php echo $transaction; ?></td>
                                    
                                   <td><?php //echo $delivery_status; ?>
                                    <td><?php //echo $transaction; ?>
                                    
                                    <td class="btn-st">
                                        <a href="<?php echo SITEURL; ?>admin/update.carts.php?id=<?php echo $id; ?>" class="btn-green btn">Update</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete.carts.php?id=<?php echo $id; ?>" class="btn-red btn">Delete</a>
                                    </td>
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
    include ('partials/footer.php');
?>