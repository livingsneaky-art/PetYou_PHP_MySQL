<?php

//to get data from form

if(isset($_POST['submit'])){
    //assign values
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_number = mysqli_real_escape_string($conn ,$_POST['customer_number']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
    $delivery_type = mysqli_real_escape_string($conn, $_POST['delivery']);
    $start = mysqli_real_escape_string($conn, $_POST['delivery_start']);
    $end = mysqli_real_escape_string($conn, $_POST['delivery_end']);
    $address = mysqli_real_escape_string($conn, $_POST['delivery_address']);
    $product_qty = $_POST['product_qty'];
    $cart_id = rand(000, 999);
    $delivery_id = rand(000, 999);
    $payment_id = rand(000, 999);
    
    //no empty values to be inserted in database
    if($customer_name == ""){
        $_SESSION['name'] = "<p class='failed'>PLEASE FILL NAME</p>";

        die();
    }

    if($customer_number == "" && $customer_email == ""){
        $_SESSION['contacts'] = "<p class='failed'>PLEASE FILL CONTACTS</p>";

        die();
    }

    if(empty($_POST['product']) ){
        $_SESSION['product'] = "<p class='failed'>PLEASE PICK YOUR product</p>";

        die();
    }


     ////for storing delivery details to delivery_details table
    $query = "INSERT INTO delivery_details
        SET id = ?,
        startTime = ?,
        endTime = ?,
        deliveryAddress = ?,
        delivery_type = (
            SELECT id 
            FROM type_delivery
            WHERE id = ?);";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssi", $delivery_id, $start, $end, $address, $delivery_type);
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
                SELECT id
                FROM product
                WHERE id = ?);";

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
    WHERE mt.id = mb.type
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
        
       echo "<h2 class='success'>BOOKED SUCCESSFULLY. Your Code: $cart_id.</h2>";

       echo "<a class='btn btn-blue' href='payment.php'>Check your order.</a>" ;
        
    } else {
        echo "<h2 class='failed'>cart FAILED</h2>";
    }
}
?>


