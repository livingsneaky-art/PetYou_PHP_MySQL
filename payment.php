<?php
ob_start();
// include header.php file
include ('header.php');
?>

    <!---main section--->
    <div style="background-color:#F7DAD9; min-height:100vh; padding-top:1em; padding-bottom:1em;">
        <div class="form-container">
            <form action="" method="POST" class="form-overlay">
                <h2>Your Order</h2>
                <div>
                
                    <label for="cart">Enter Code</label>
                    <input type="text" name="cart">
              
                   <button class="button" type="submit" name="submit" >Submit</button> 
                   
                </div>
                
            <?php
                if(isset($_POST['submit'])){
                    $cart = mysqli_real_escape_string($conn, $_POST['cart']);

                    if($cart){
                    
                        $order = "SELECT * FROM cart WHERE id = ?;";
                        $stmt_order = $conn->prepare($order);
                        $stmt_order->bind_param("i", $cart);
                        $stmt_order->execute();

                        $res_order = $stmt_order->get_result();
                        
                        if (!$stmt_order){

                            echo "<h2 class='failed'>NOT FOUND!</h2>";
                              
                        } else {
                            while($rows_order = $res_order->fetch_assoc()){
                                $delivery = $rows_order['deliveryID'];
                                $customer_name = $rows_order['customer_name'];
                                $customer_contact_no = $rows_order['customer_contact_no'];
                                $customer_email = $rows_order['customer_email'];  
                        ?>

                        <br>
                            <div>
                                    <h4>Customer Name:</h4>
                                    <p><?php echo $customer_name; ?></p> 
                            </div>
                            <div>
                                    <h4>Customer Number:</h4>
                                    <p><?php echo $customer_contact_no; ?></p> 
                            </div>
                            <div>
                                    <h4>Customer Email:</h4>
                                    <p><?php echo $customer_email; ?></p>
                            </div>
                            <?php
                                $delivery_query = "SELECT * FROM delivery_details WHERE id = ?;";
    
                                $delivery_stmt = $conn->prepare($delivery_query);
                                $delivery_stmt->bind_param("i", $delivery);
                                $delivery_stmt->execute();
                                $res_delivery = $delivery_stmt->get_result();
                                $row_delivery = $res_delivery->fetch_assoc();
                                
                                $id = $row_delivery['id'];
                                $delivery_get = $row_delivery['delivery_type'];
                                $start = $row_delivery['startTime'];
                                $end = $row_delivery['endTime'];
                                $deliveryAddress = $row_delivery['deliveryAddress'];
                
                                $sql_2 = "SELECT * FROM type_delivery WHERE id = ?;";
                
                                $stmt_2 = $conn->prepare($sql_2);
                                $stmt_2->bind_param("i", $delivery_get);
                                $stmt_2->execute();
                                $res_2 = $stmt_2->get_result();
                                $row_2 = $res_2->fetch_assoc();
                                $delivery_id = $row_2['id'];
                                $delivery_title = $row_2['title'];
                        ?>
                        <br>
                        <div>
                                <h4>delivery Type:</h4>
                                <p><?php echo $delivery_title; ?></p>
                        </div>
                        <div>
                                <h4>Time Start:</h4>
                                <p><?php echo $start; ?></p>
                                
                        </div>
                        <div>
                                <h4>Time End:</h4>
                                <p><?php echo $end; ?></p>
                                
                        </div>
                        <div>
                                <h4>Address:</h4>
                                <p><?php echo $deliveryAddress; ?></p> 
                        </div>
    
                        <table class="tbl-full" style="height:auto; table-layout: auto;
    width: 100%;">
                        <br>
                            <h3>product/Extras</h3>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
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
                                                
                                            </tr>
    
                                            <?php
                                            }
                                ?>
                               
                            </table>
                            <table class="tbl-full" style="height:auto; table-layout: auto;
    width: 100%;">
                                <tr>
                                    
                                    <th>Total</th>
                                    <th>product Total</th>
                                    <th>Minimum Payment</th>
                                    <th>Paid</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
    
                                <?php
                                    //TO GET DATA
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
                                                $total = $rows['total'];
                                                $status = $rows['status'];
    
                                                ?>
    
                                                <tr>
                                                    
                                                    <td><?php echo $total; ?></td>
                                                    <td><?php echo $product; ?></td>
                                                    <td><?php echo $min; ?></td>
                                                    <td><?php echo $paid; ?></td>
                                                    <td><?php echo $balance; ?></td>
                                                    <?php
                                            }
                                        }
                                    }
                                    //TO GET DATA
                                    $sql = "SELECT * FROM carts
                                    WHERE id =  $cart;";
                                    //CATCHER
                                    $res = mysqli_query($conn, $sql);
    
                                    if ($res == TRUE){
                                        // PRESENT ROWS
                                        $count = mysqli_num_rows($res);
    
                                        if ($count > 0){
                                            //Loop through data
                                            while($rows = mysqli_fetch_assoc($res)){
                                                $transaction = $rows['transaction_status'];
                                                $status = $rows['status'];
    
                                                ?>
                                                    <td><?php echo $status; ?></td>
                                                    <td><?php echo $transaction; ?></td>
                                                </tr>
    
                                            <?php
                                            }
                                        }
                                    } else {
    
                                    }
                                    ?>
                                    </table>
                                    <?php
                                    if ($status == 'Pending'){
                                        ?>
                                        <br>
                                        <h3>Please wait for your order to be confirmed before paying.</h3>
                                        <?php
                                    }
                        }
                            ?>

                            <?php
                        }
                    }
                }

                            ?>

                    <div>
                        <h2>We Accept Payment:</h2>
                        <div>
                            <h4>GCash</h4>
                            <ul>
                                <li>Go to GCash app and select "Send Money". Pick "Express Send".</li>
                                <li>Send to: 09326426458.</li>
                                <li>Enter amount.</li>
                                <li>Enter your name and given code as Message.</li>
                                <li>Example:</li>
                                <img src="images/pay.jpg" style="width:400px;">
                            </ul>
                        </div>
                        <br>
                        <div>
                            <h4>Cash Payment</h4>
                            <ul>
                                <li>Visit our office at Poblacion, Jagna, Bohol.</li>
                            </ul>
                        </div>
                    </div>
                </form>
        </div>
    </div>

<?php
// include footer.php file
include ('footer.php');
?>


