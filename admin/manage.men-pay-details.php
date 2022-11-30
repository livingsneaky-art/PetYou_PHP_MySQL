<?php
   ob_start();
    // include header.php file
    include ('partials/header.php');
?>
<div class="main" style="height:100vh;">
        <div class="container">
            <h2>PAYMENT DETAILS</h2>
            

            <?php

                if (isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if (isset($_SESSION['update-delivery'])){
                    echo $_SESSION['update-delivery'];
                    unset($_SESSION['update-delivery']);
                }

            ?>

            <table class="tbl-full" style="height:auto;">
            <?php
                    //TO GET DATA
                    $cart = $_GET['cart']; ?>

            <a href="<?php echo SITEURL; ?>admin/update.carts.php?id=<?php echo $cart; ?>" class="btn-blue btn">Back to cart details</a>
                <tr>
                    <th>Product Total</th>
                    <th>Balance</th>
                    <th>Paid</th>
                   
                </tr>
                    <?php

                     

                    $sql = "SELECT * FROM payment_details
                    WHERE id = (
                        SELECT receiptID
                        FROM cart
                        WHERE id = $cart);";
                    //CATCHER
                    $res = mysqli_query($conn, $sql);

                    if ($res == TRUE){
                        // PRESENT ROWS
                        $count = mysqli_num_rows($res);

                        if ($count > 0){
                            //Loop through data
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $product = $rows['products_total'];
                                $min = $rows['minPayment'];
                                $paid = $rows['paid'];
                                $balance = $rows['balance'];
                                $status = $rows['status'];
                                $total = $rows['total'];

                                ?>

                                <tr>
                                    
                                    <td><?php echo $product; ?></td>
                                    <td><?php echo $balance; ?></td>
                                    <td><?php echo $status; ?></td>
                                    
                                  
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
    include('partials/footer.php');
?>