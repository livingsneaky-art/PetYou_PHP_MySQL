<?php
ob_start();
// include header.php file
include ('header-customer_Cart,Check&Profile.php');
include('login.check.php');
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
<?php
    $id = $_SESSION['id'];
   
    $sql = "SELECT * FROM user WHERE userID=$id";
    $res = $conn->query($sql) or die(mysqli_error($conn));;
    if($res == TRUE){
        $count = mysqli_num_rows($res);

        if($count == 1){
            $row = mysqli_fetch_assoc($res);
            $fName = $row['fName'];
            $lName = $row['lName'];
            $customer_number = $row['customer_contact_no'];
            $customer_email = $row['customer_email'];
            //$delivery_start = $row['delivery_start'];
            //$delivery_end = $row['delivery_end'];
            $Address = $row['deliveryAddress'];
        }
    }
    $_POST['fName'] = $fName;
    $_POST['lName'] = $lName;
    $_POST['customer_name'] = $fName." ".$lName;
    $_POST['customer_number'] = $customer_number;
    $_POST['customer_email'] = $customer_email;
    $_POST['delivery_address'] = $Address;
    
   
    if(isset($_POST['submit']) && isset($_POST['product'])){
        //assign values
        $customer_name = $_POST['customer_name'];
        $customer_number = $_POST['customer_number'];
        $customer_email = $_POST['customer_email'];
        $delivery_type = $_POST['delivery'];
        //$start = mysqli_real_escape_string($conn, $_POST['delivery_start']);
        //$end = mysqli_real_escape_string($conn, $_POST['delivery_end']);
        $address =  $_POST['delivery_address'];
        $product_qty = $_POST['product_qty'];
        //$product_qty = 1;
        $cart_id = rand(000, 999);
        $delivery_id = rand(000, 999);
        $payment_id = rand(000, 999);
        
     

    
         ////for storing delivery details to delivery_details table
        $query = "INSERT INTO delivery_details
            SET id = ?,
            deliveryID = ?,
            deliveryAddress = ?,
            delivery_type = (
                SELECT id 
                FROM type_delivery
                WHERE id = ?);";
    
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iisi",$delivery_id, $delivery_id, $address, $delivery_type);
        $res_delivery = $stmt->execute();
    
        if (!$res_delivery){
            echo $conn->error;
        }
    
        //create cart record
        $query_2 = "INSERT INTO cart
            SET id = ?,
            customer_name = ?,
            customer_contact_no = ?,
            customer_email = ?,
            deliveryID = (
                SELECT id
                FROM delivery_details
                WHERE id = ?);";
    
        $stmt_2 = $conn->prepare($query_2);
        $stmt_2->bind_param("isssi", $cart_id, $customer_name, $customer_number, $customer_email, $delivery_id);
        $res_book = $stmt_2->execute();
        
        if (!$res_book){
            echo $conn->error;
        }
        
        //create product record
     
        if (!empty($_POST['product'])){
          $products = $_POST['product'];
            
            $product_query = "INSERT INTO product_carts
                SET
                quantity = ?,
                cartID = (
                    SELECT id
                    FROM cart
                    WHERE id = ?),
                type = (
                    SELECT productID
                    FROM product
                    WHERE productID = ?);";
    
            $product_stmt = $conn->prepare($product_query);
            $product_stmt->bind_param("iii", $p_qty, $cart_id, $product);

            foreach ($products as $product){
              $p_qty = $product_qty[$product];
              $res_product = $product_stmt->execute();
          }
           
            if(!$res_product){
                echo $conn->error;
            }
        }
        
        //create payment record
    
        //calculate fees
        $product_sql = "SELECT SUM(mt.price * mb.quantity) as 'product total'
        FROM product mt, product_carts mb
        WHERE mt.productID = mb.type
        AND mb.cartID = ?;";
    
        $stmt_product = $conn->prepare($product_sql);
        $stmt_product->bind_param("i", $cart_id);
        $stmt_product->execute();
        $result_product = $stmt_product->get_result();
        $row_product = $result_product->fetch_assoc();
        $product_total = $row_product['product total'];
    
    
        $total = $product_total;
        $min = $total * .50;
    
        //create payment details
        $query_pay = "INSERT INTO payment_details
            SET id = ?,
            products_total = ?,
            total = ?,
            balance = ?,
            minPayment = ?;
          ";
    
        $stmt_pay = $conn->prepare($query_pay);
        $stmt_pay->bind_param("iiiii", $payment_id, $product_total, $total, $total, $min);
        $res_pay = $stmt_pay->execute();
    
        if(!$res_pay){
            echo $conn->error;
        } 
    
        //add receipt to cart record
        $query_cart = "UPDATE cart
            SET receiptID = (
                SELECT id 
                FROM payment_details
                WHERE id = ?)
            WHERE id = ?;
          ";
    
        $stmt_carts = $conn->prepare($query_cart);
        $stmt_carts->bind_param("ii", $payment_id, $cart_id);
        $res_carts = $stmt_carts->execute();
       
        if ($res_carts){
            $_SESSION['cart_id'] = $cart_id;
          header("Location: gcash.php");
           //echo "<a class='btn btn-blue' href='payment.php'>Check your order.</a>" ;
         
            
        }else {
           echo "<h2 class='failed'>cart FAILED</h2>";
        }
    }else{
      if(!isset($_POST['product'])){
        if(isset($_POST['submit'])){
          echo  "<script> alert('PLEASE SELECT PRODUCT'); </script>";
        }
        
      }
      
    }
            
          

       
           
?>

<div class="p-3 text-center login_petyou" ><a style="text-decoration: none; color: #BFD8BD;" href="payment.php">CHECKOUT</a></div>
<form method="post">
<section id="product" style="background-color: #98C9A3;">
  <div class="container py-5">
    <div class="card">
      <div class="card-body">
        <div class="row d-flex justify-content-center pb-5">
          <div class="col-md-7 col-xl-5 mb-4 mb-md-0">
            <div class="py-4 d-flex flex-row">
              <h5><span ></span><b>Review Payment and Delivery Details</b></h5>
              <!-- <span class="ps-2">Pay</span> -->
            </div>
            
            <!-- DELIVERY DETAILS INPUT -->
            
            <h4 class="text-success">Delivery Details</h4>
            <div class="row pt-2 ">
                <div class="form-group col-md-6">
                  <h3 type="text" class="form-control"> <?php echo $_POST['fName']?></h3>
                </div>

                <div class="form-group col-md-6">
                  <h3 type="text" class="form-control"> <?php echo $_POST['lName']?></h3>
                </div>
            </div>
            
            <div class="rounded">
                <div class="form-group">
                  <h3 type="text" class="form-control"> <?php echo $_POST['delivery_address']?></h3>
                </div>
            </div>
            <div class="rounded ">
                <div class="form-group">
                  <h3 type="text" class="form-control"> <?php echo $_POST['customer_email']?></h3>
                </div>
            </div>
            <hr />
            <p>
              <b>Delivery Mode </b><br>
            </p>
           
            <select name="delivery" id="">
              <?php
                  //to get data from database
                  $sql = "SELECT * FROM type_delivery;";
                  //execute the query
                  $res = mysqli_query($conn, $sql);
                  //count rows
                  $count = mysqli_num_rows($res);

                  if($count > 0){
                      while($row = mysqli_fetch_assoc($res)){
                          $title = $row['title'];
                          $DeliverID = $row['id'];
              ?>
                  <option value="<?php echo $DeliverID; ?>"><?php echo $title; ?></option>
                  <?php 
                      }
                  } 
              ?>
          </select>
            <!-- PAYMENT MODE -->
            <div class="pt-2">
              <div class="d-flex pb-2">
                <div>
                  <p>
                    <b>Payment Mode </b>
                  </p>
                </div>
              </div>
              
             
                <div class="d-flex flex-row pb-3">
                  
                  <div class="rounded border d-flex w-100 p-3 align-items-center">
                    <p class="mb-0">
                        <img src="./assets/transactions/gcash.png" alt="gcash" style="width=80vh"; height="50vh">
                      <i class="text-primary pe-2"></i>Gcash
                    </p>
                    <div class="ms-auto"><?php echo $_POST['customer_number']?></div>
                    
                  </div>
                </div>

             
              
              <!-- PAYMENT BUTTON -->
              
              <input type="submit" name="submit" value="Proceed to Payment" class="btn btn-primary btn-block btn-lg" />
             
            </div>
          </div>
            
          <div class="col-md-5 col-xl-4 offset-xl-1">
            <div class="py-4 d-flex justify-content-end">
              <!-- <h6><a href="#!">Back</a></h6> -->
            </div>
            <?php
            $subTotal = 0;
            $id = $_SESSION['id'];
            $sql = "SELECT * FROM product p, bridge b WHERE p.productID = b.productID AND b.userID = $id"; 
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $_SESSION['count'] = $count;
            ?>
            <!-- CART -->
            <div class="container h-75 overflow-auto">
              <div class="rounded d-flex flex-column p-2" style="background-color: #f8f9fa;">
                <div class="p-2 me-3 d-flex" style="display:flex;">
                  <h4  style="flex:1;">YOUR CART</h4>
                  
                  <p class="badge" ><?php echo isset($subTotal) ? $count : 0; ?></p>
                </div>
              </div>
              <?php
                if($count > 0){
                while($row = $res->fetch_assoc()){
                 // $prodID = $row['productID'];
                    
            ?>
            
              <div class="p-2 d-flex">
              <input type="checkbox" name="product[]" value="<?php echo $row['productID']; ?>">
                <div class="col-8 align-items-center">
                    <div class="d-flex align-items-center">
                    
                    <img src="<?php echo SITEURL; ?>images/product/<?php echo $row['image']; ?>" alt="" class="round" style="width: 12vh; height: 10vh;">
                    <input type="hidden" name="productID" value="<?php echo $row['productID'] ?? '1'; ?>">
                    
                    <h5 class="ms-5"><?php echo $row['title'] ?? "Unknown"; ?></h5>
                    
                    </div>
                </div>
                  <span class="product_price text-success ms-auto align-items-center d-flex" data-id="<?php echo $row['productID'] ?? '0'; ?>">₱<?php echo $row['price'] ?? 0; ?></span>
                  
              </div>
              
              <div class="qty d-flex pt-2">
              <div class="d-flex font-rale w-15">
              
                <input type="text" name="product_qty[<?php echo $row['productID']; ?>]" data-id="<?php echo $row['productID'] ?? '0'; ?>" class="qty_input qty-up border px-3 w-50 bg-white text-center"  value="1" placeholder="1" >  
                
  
              </div> 
               
              </div>
              
              <?php
                 $subTotal += $row['price'];
              }
            }
               ?> 
               <div style="padding-top: 40px;">
                <button data-id="<?php echo $row['productID'] ?? '0'; ?>" class="qty-down border-0 bg-white text-success"> <p style="font-weight: bold;">Reset</p></button> 
               </div>  
            </div>
           
            <!-- TOTAL -->
            <div class="px-2 mx-2 w-75 border-top"></div>
              <div class="p-2 d-flex pt-3">
                <div class="col-8"><b>Subtotal ( <?php echo isset($subTotal) ? $count : 0; ?> item):&nbsp;</b></div>
                <span class="text-danger">₱<span class="text-danger" id="deal-price"><?php echo isset($subTotal) ? $subTotal : 0;?></span>
              </div>
            </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</form>
    </div>
    


<?php
// include footer.php file
include ('footer.php');
?>


</body>
</html>