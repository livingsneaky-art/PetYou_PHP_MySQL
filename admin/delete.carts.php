<?php

    include('../configs/constants.php');
    include('login.check.php');

    //Getting the id to be deleted
    $id = $_GET['id'];

    //creating sql command to delete

    $del_product = "DELETE FROM product_carts WHERE cartID = ?;";
    $stmt_product = $conn->prepare($del_product);
    $stmt_product->bind_param("i", $id);
    $stmt_product->execute();

    $sql_delivery = "SELECT deliveryID FROM cart WHERE id = ?;";
    $stmt_e  = $conn->prepare($sql_delivery);
    $stmt_e->bind_param("i", $id);
    $stmt_e->execute();
    $res_e = $stmt_e->get_result();
    $row_e = $res_e->fetch_assoc();
    $delivery_id = $row_e['deliveryID'];
  

    $sql_pay = "SELECT receiptID FROM cart WHERE id = ?;";
    $stmt_p  = $conn->prepare($sql_pay);
    $stmt_p->bind_param("i", $id);
    $stmt_p->execute();
    $res_p = $stmt_p->get_result();
    $row_p = $res_p->fetch_assoc();
    $payment_id = $row_p['receiptID'];

    $del_cart = "DELETE FROM cart WHERE id = ?;";
    $stmt_cart = $conn->prepare($del_cart);
    $stmt_cart->bind_param("i", $id);
    $res = $stmt_cart->execute();

    $del_delivery = "DELETE FROM delivery_details WHERE id = ?;";
    $stmt_delivery = $conn->prepare($del_delivery);
    $stmt_delivery->bind_param("i", $delivery_id);
    $res_e = $stmt_delivery->execute();

    $del_pay = "DELETE FROM payment_details WHERE id = ?;";
    $stmt_payment = $conn->prepare($del_pay);
    $stmt_payment->bind_param("i", $payment_id);
    $res_p = $stmt_payment->execute();

    if ($res == TRUE){
        //creating session 
        $_SESSION['delete'] = "<h2 class='success'>DELETED SUCCESSFULLY</h2>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage.carts.php');
    } else {
        $_SESSION['delete'] = "<h2 class='failed'>DELETE FAILED</h2>";
        header('location:'.SITEURL.'admin/manage.carts.php');
    }