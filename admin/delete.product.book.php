<?php

    include('../configs/constants.php');
    include('login.check.php');

    //Getting the id of admin to be deleted
    $product_id = $_GET['product_id'];
    
    $cart = $_GET['cart'];

    //creating sql command to delete admin
    $sql_product = "DELETE FROM product_carts WHERE type= ? AND cartID = ?;";
    $stmt_product = $conn->prepare($sql_product);
    $stmt_product->bind_param("ii", $product_id, $cart);
    $stmt_product->execute();

    $product_sql = "SELECT SUM(mt.price) as 'product total'
        FROM product mt, product_carts mb
        WHERE mt.id = mb.type
        AND mb.cartID = ?;";
    $stmt_product2 = $conn->prepare($product_sql);
    $stmt_product2->bind_param("i", $cart);
    $stmt_product2->execute();
    $result_product = $stmt_product2->get_result();
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
        $payment_id = $row_pay['receiptID'] ;

    $sql_pay = "UPDATE payment_details 
            SET
            extras_total = ?,
            products_total = ?,
            total = ?,
            balance = ?,
            minPayment = ?
          WHERE id = ?;";


    $stmt_pay = $conn->prepare($sql_pay);
    $stmt_pay->bind_param("iiiiii", $extras_total, $product_total, $total, $total, $min, $payment_id);
    $res = $stmt_pay->execute();

    if ($res == TRUE){
        //creating session 
        $_SESSION['delete'] = "<h2 class='success'>DELETED SUCCESSFULLY</h2>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/update.orders.php?cart='. $cart);
    } else {

        $_SESSION['delete'] = "<h2 class='failed'>DELETE FAILED</h2>";

        header('location:'.SITEURL.'admin/update.orders.php?cart='. $cart);
    }