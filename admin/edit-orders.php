<?php
  //include('login.check.php');
  

if(isset($_POST['submit'])){    
    //no empty values to be inserted in database
    $cart = $_POST['cart'];
    $product_qty = $_POST['product_qty'];
    
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
        $product_stmt->bind_param("iii", $m_qty, $cart, $product);

        foreach ($products as $product){
            $m_qty = $product_qty[$product];
           $res_product = $product_stmt->execute();
        }

        if(!$res_product){
            echo $conn->error;
        }
    }


    //calculate fees
    $product_sql = "SELECT SUM(mt.price * mb.quantity) as 'product total'
    FROM product mt, product_carts mb
    WHERE mt.id = mb.type
    AND mb.cartID = ?;";

    $stmt_product = $conn->prepare($product_sql);
    $stmt_product->bind_param("i", $cart);
    $stmt_product->execute();
    $result_product = $stmt_product->get_result();
    $row_product = $result_product->fetch_assoc();
    $product_total = $row_product['product total'];

   

    $total = $product_total;
    $min = $total * .50;


    $payid_query = "SELECT receiptID FROM cart 
                    WHERE id = ?;";
    $pay = $conn->prepare($payid_query);
    $pay->bind_param("i", $cart);
    $pay->execute(); 
    $res_pay_id = $pay->get_result(); 
    $row_pay = $res_pay_id->fetch_assoc();
    $payment_id = $row_pay['receiptID'];
    
    //create payment details
    $query_pay = "UPDATE payment_details
        SET 
        products_total = ?,
        total = ?,
        balance = ?,
        minPayment = ?
        WHERE id = ?;
      ";

    $stmt_pay = $conn->prepare($query_pay);
    $stmt_pay->bind_param("iiiii", $product_total, $total, $total, $min, $payment_id);
    $res_pay = $stmt_pay->execute();

    if(!$res_pay){
        echo $conn->error;
    } 

    //add receipt to cart record
    

    if ($res_pay){
        
       echo "<h2 class='success'>BOOKED SUCCESSFULLY.</h2>";

       echo "<a class='btn btn-blue' href='update.orders.php?cart=$cart'>Back to orders.</a>" ;
        
    } else {
        echo "<h2 class='failed'>cart FAILED</h2>";
    }
}
?>