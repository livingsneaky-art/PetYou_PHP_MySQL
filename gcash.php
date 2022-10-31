<?php
ob_start();
// include header.php file
include ('header-customer_Cart,Check&Profile.php');
include('login.check.php');
?>

    <!---main section--->
    <center>
    <div style="background-color:#FFFFE9; min-height:100vh; padding-top:1em; padding-bottom:1em;">
        
                
            <?php
            //$_POST['cart_id'] = 17;
               if(isset($_SESSION['cart_id'])){
                    $cart =  mysqli_real_escape_string($conn, $_SESSION['cart_id']);  
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
    
                                                    
                                   

                            
    <center>
                    <div>
                        <div>
                        <h4>GCash</h4>
                        
                        <p class="text-danger">Total to Pay: </p><?php echo $product; ?>
                            <p></p>
                            <ul>
                                <p>Go to GCash app and select "Send Money". Pick "Express Send".</p>
                                <p class="text-success">Send to: 09326426458.</p>
                                <p>Enter amount.</p>
                                <p>Enter your name as Message.</p>
                                <p>Example:</p>
                                <img src="images/pay.jpg" style="width:400px;">
                            </ul>
                        </div>
                        <br>
                        <div>
                            <h4>Cash Payment</h4>
                            <ul>
                                <p>Talamban, Cebu City.</p>
                            </ul>
                        </div>
                    </div>
                    </center>
                    <?php
                    }
                }
            }
        }
    }
}
}
                    ?>
                          
          
    </div>
               

<?php
// include footer.php file
include ('footer.php');
?>


