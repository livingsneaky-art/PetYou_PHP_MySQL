<?php

    include('../configs/constants.php');
    

    //Getting the id of admin to be deleted
    $id = $_GET['id'];

    //creating sql command to delete admin
    $sql = "DELETE FROM user WHERE userID=$id;";

    //to execute the query
    $res = $conn->query($sql);

    if ($res == TRUE){
        //creating session 
       
        // $_SESSION['delete'] = "<h2 class='success'>DELETED SUCCESSFULLY</h2>";
        $_SESSION['delete'] =  '<script>alert("Deleted Successfully")</script>';
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage.admin.php');
    } else {
        // $_SESSION['delete'] = "<h2 class='failed'>DELETE FAILED</h2>";
        $_SESSION['delete'] =  '<script>alert("Delete Failed")</script>';
        header('location:'.SITEURL.'admin/manage.admin.php');
    }