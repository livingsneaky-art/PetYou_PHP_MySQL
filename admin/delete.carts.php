<?php

    include('../configs/constants.php');
    include('login.check.php');

    //Getting the id to be deleted
    $id = $_GET['id'];

    //creating sql command to delete
    $del_extras = "DELETE FROM extras_bookings WHERE bookingID = ?;";
    $stmt_extras = $conn->prepare($del_extras);
    $stmt_extras->bind_param("i", $id);
    $stmt_extras->execute();

    $del_menu = "DELETE FROM menus_bookings WHERE bookingID = ?;";
    $stmt_menu = $conn->prepare($del_menu);
    $stmt_menu->bind_param("i", $id);
    $stmt_menu->execute();

    $sql_event = "SELECT eventID FROM bookings WHERE id = ?;";
    $stmt_e  = $conn->prepare($sql_event);
    $stmt_e->bind_param("i", $id);
    $stmt_e->execute();
    $res_e = $stmt_e->get_result();
    $row_e = $res_e->fetch_assoc();
    $event_id = $row_e['eventID'];
  

    $sql_pay = "SELECT receiptID FROM bookings WHERE id = ?;";
    $stmt_p  = $conn->prepare($sql_pay);
    $stmt_p->bind_param("i", $id);
    $stmt_p->execute();
    $res_p = $stmt_p->get_result();
    $row_p = $res_p->fetch_assoc();
    $payment_id = $row_p['receiptID'];

    $del_booking = "DELETE FROM bookings WHERE id = ?;";
    $stmt_booking = $conn->prepare($del_booking);
    $stmt_booking->bind_param("i", $id);
    $res = $stmt_booking->execute();

    $del_event = "DELETE FROM event_details WHERE id = ?;";
    $stmt_event = $conn->prepare($del_event);
    $stmt_event->bind_param("i", $event_id);
    $res_e = $stmt_event->execute();

    $del_pay = "DELETE FROM payment_details WHERE id = ?;";
    $stmt_payment = $conn->prepare($del_pay);
    $stmt_payment->bind_param("i", $payment_id);
    $res_p = $stmt_payment->execute();

    if ($res == TRUE){
        //creating session 
        $_SESSION['delete'] = "<h2 class='success'>DELETED SUCCESSFULLY</h2>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage.bookings.php');
    } else {
        $_SESSION['delete'] = "<h2 class='failed'>DELETE FAILED</h2>";
        header('location:'.SITEURL.'admin/manage.bookings.php');
    }