<?php
ob_start();
// include header.php file
include ('header-customer_Cart,Check&Profile.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/login.css">
</head>
<body>

<div class="container" style="min-height:100vh">
<!-- FROM HERE (commented) -->
    <!-- <div style="min-height:100vh;> -->
        
                
            <!-- <?php
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
    
                        <table class="tbl-full" style="height:auto; table-layout: auto; width: 100%;">
                        <br>
                            <h3>PRODUCT</h3>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                                <?php
                                    //TO GET DATA
                                    $query_product = "SELECT mt.productID, mt.title, mt.description, mt.price, mb.quantity FROM product mt, product_carts mb
                                    WHERE mt.productID = mb.type
                                    AND mb.cartID = ?;";  
                                    
                                    $stmt_product = $conn->prepare($query_product);
                                    $stmt_product->bind_param("i", $cart);
                                    $stmt_product->execute();
                                    $res_product = $stmt_product->get_result();
                                
                                            //Loop through data
                                        while($rows_product = $res_product->fetch_assoc()){
                                            $product_id = $rows_product['productID'];
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
                            <table class="tbl-full" style="height:auto; table-layout: auto;width: 100%;">
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
                    </div>  -->
<!-- TO HERE -->
<!-- vv FRONT END STARTS HERE vv -->
<div class="p-3 text-center login_petyou" ><a style="text-decoration: none; color: #BFD8BD;" href="index.php">CHECKOUT</a></div>
<section style="background-color: #98C9A3;">
  <div class="container py-5">
    <div class="card ">
      <div class="card-body">
        <div class="row d-flex justify-content-center pb-5">
          <div class="col-md-7 col-xl-5 mb-4 mb-md-0">
            <div class="py-4 d-flex flex-row">
              <h5><span class="far fa-check-square pe-2"></span><b>Review Payment and Delivery Details</b></h5>
              <!-- <span class="ps-2">Pay</span> -->
            </div>

            <!-- DELIVERY DETAILS INPUT -->
            <h4 class="text-success">Delivery Details</h4>
            <div class="row pt-2 ">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>

                <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Ndsdse">
                </div>
            </div>
            
            <div class="rounded">
                <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
            </div>
            <div class="rounded ">
                <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
            </div>
            <div class="rounded ">
                <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
            </div>
            <hr />

            <!-- PAYMENT MODE -->
            <div class="pt-2">
              <div class="d-flex pb-2">
                <div>
                  <p>
                    <b>Paayment Mode </b>
                  </p>
                </div>
              </div>
              
              <form class="pb-3">
                <div class="d-flex flex-row pb-3">
                  
                  <div class="rounded border d-flex w-100 p-3 align-items-center">
                    <p class="mb-0">
                        <img src="./assets/transactions/gcash.png" alt="gcash" style="width=80vh"; height="50vh">
                      <i class="text-primary pe-2"></i>Gcash
                    </p>
                    <div class="ms-auto">Talamban, Cebu City</div>
                    
                  </div>
                </div>

             
              </form>
              <!-- PAYMENT BUTTON -->
              <input type="button" value="Proceed to payment" class="btn btn-primary btn-block btn-lg" />
            </div>
          </div>
            
          <div class="col-md-5 col-xl-4 offset-xl-1">
            <div class="py-4 d-flex justify-content-end">
              <!-- <h6><a href="#!">Back</a></h6> -->
            </div>
            
            <!-- CART -->
            <div class="container h-75 overflow-auto">
              <div class="rounded d-flex flex-column p-2" style="background-color: #f8f9fa;">
                <div class="p-2 me-3 d-flex" style="display:flex;">
                  <h4  style="flex:1;">YOUR CART</h4>
                  
                  <p class="badge" >3</p>
                </div>
              </div>

              <div class="p-2 d-flex">
                <div class="col-8 align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="./assets/transactions/gcash.png" alt="product 1"  class="round" style="width: 12vh; height: 10vh;">
                        <p class="ms-5">sdsdsd</p>
                    </div>
                </div>
                <p class="ms-auto align-items-center d-flex">₱186.76</p>
              </div>

              <div class="p-2 d-flex">
                <div class="col-8 align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="./assets/transactions/gcash.png" alt="product 1"  class="round" style="width: 12vh; height: 10vh;">
                        <p class="ms-5">sdsdsd</p>
                    </div>
                </div>
                <p class="ms-auto align-items-center d-flex">₱186.76</p>
              </div>

              <div class="p-2 d-flex " >
                <div class="col-8 align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="./assets/transactions/gcash.png" alt="product 1"  class="round" style="width: 12vh; height: 10vh;">
                        <p class="ms-5">sdsdsd</p>
                    </div>
                </div>
                <p class="ms-auto align-items-center d-flex">₱186.76</p>
              </div>

              <div class="p-2 d-flex " >
                <div class="col-8 align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="./assets/transactions/gcash.png" alt="product 1"  class="round" style="width: 12vh; height: 10vh;">
                        <p class="ms-5">sdsdsd</p>
                    </div>
                </div>
                <p class="ms-auto align-items-center d-flex">₱186.76</p>
              </div>

              
            </div>
            
            <!-- TOTAL -->
            <div class="px-2 mx-2 w-75 border-top"></div>
              <div class="p-2 d-flex pt-3">
                <div class="col-8"><b>Total</b></div>
                <div class="ms-auto"><b class="text-success">₱85.00</b></div>
              </div>
            </div>
            </div>
            



          </div>
        </div>
      </div>
    </div>
  </div>
</section>
          
    </div>
</div>
    

<?php
// include footer.php file
include ('footer.php');
?>


</body>
</html>