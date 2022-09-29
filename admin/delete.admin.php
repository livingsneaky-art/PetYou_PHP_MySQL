<?php

    include('../configs/constants.php');
    include('login.check.php');
    

    //Getting the id of admin to be deleted
    $id = $_GET['id'];

    //creating sql command to delete admin
    $sql = "DELETE FROM admin WHERE id=$id;";

    //to execute the query
    $res = $conn->query($sql);

    if ($res == TRUE){
        //creating session 
        $_SESSION['delete'] = "<h2 class='success'>DELETED SUCCESSFULLY</h2>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage.admin.php');
    } else {
        $_SESSION['delete'] = "<h2 class='failed'>DELETE FAILED</h2>";
        header('location:'.SITEURL.'admin/manage.admin.php');
    }