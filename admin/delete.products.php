<?php 

    include('../configs/constants.php');
    include('login.check.php');

    if(isset($_GET['id']) AND isset($_GET['image'])){

        ///get id to delete
        $id = $_GET['id'];
        $image = $_GET['image'];

       

        //creating sql command to delete
        $sql = "DELETE FROM product WHERE productID=$id;";

        //to execute the query
        $res = $conn->query($sql);

        if ($res == TRUE){
            //to remove image file
            if ($image != ""){
                $path = "../images/product/".$image;
                $remove = unlink($path);
    
                if($remove == FALSE){
                    $_SESSION['remove'] = "<h2 class='failed'>FAILED TO REMOVE IMAGE</h2>";
                    //redirect to manage page
                    header('location:'.SITEURL.'admin/manage.products.php');
    
                    die();
                }
            }
            //creating session 
            // $_SESSION['delete'] = "<h2 class='success'>DELETED SUCCESSFULLY</h2>";
            $_SESSION['delete'] =  '<script>alert("Deleted Successfully")</script>';
            //redirect to manage page
            header('location:'.SITEURL.'admin/manage.products.php');
        } else {
            // $_SESSION['delete'] = "<h2 class='failed'>DELETE FAILED</h2>";
            $_SESSION['delete'] =  '<script>alert("Delete Failed")</script>';
            header('location:'.SITEURL.'admin/manage.products.php');
        }

    } else {
        header('location:'.SITEURL.'admin/manage.products.php');
    }
?>