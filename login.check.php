<?php

    if(!isset($_SESSION['user'])){
        $_SESSION['no-login-message'] = "<script> alert('Please login to access the page'); </script>";
        "<script> alert('Please login to access the page'); </script>";
        header('location:'.SITEURL.'login-page.php');
        
    }

?>