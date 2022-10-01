<?php
   ob_start();
    // include header.php file
    include ('partials/header.php');
?>

    <!---main section--->
    
    <div class="main">
        <div class="add-body" style="height:57.6vh">
            <div class="container">
                <h1>ADD DELIVERY</h1>

            <?php
                    if (isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                ?>

                <form action="" method="POST" class="form" enctype="multipart/form-data">
                <div>
                        <label for="title">Event Name:</label>
                        <input type="text" name="title">  
                </div>
                <div>
                        <label for="image">Image:</label>
                        <input type="file" name="image">  
                </div>
                <button class="button" type="submit" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
<?php

    if(isset($_POST['submit'])){

        //get data from form
        $name = $_POST['title'];

        //for image file
        if(isset($_FILES['image']['name'])){
            //for image name
            $image_name = $_FILES['image']['name'];
            ///to rename the image
            $ext = end(explode('.', $image_name));
            $image_name = "Delivery_".rand(000, 999).'.'.$ext;
            //for image source
            $source = $_FILES['image']['tmp_name'];
            //destination
            $dest = "../images/delivery/".$image_name;
            //to upload the image
            $upload = move_uploaded_file($source, $dest);

            if($upload == FALSE){
                $_SESSION['upload'] = "<h2 class='failed'>UPLOAD IMAGE FAILED</h2>";
                header("location:".SITEURL."admin/add.delivery.php");

                die();
            }
        } else {
            $image_name = "";
        }

        //SQL query to insert to database
        $sql = "INSERT INTO type_delivery(title, image_name) VALUES('$name', '$image_name');";

        //execute the query
        $res = $conn->query($sql);

        if ($res == TRUE){
            $_SESSION['add'] = "<h2 class='success'>OPERATION SUCCESSFUL</h2>";
            header("location:".SITEURL."admin/manage.delivery.php");
        } else {
            $_SESSION['add'] = "<h2 class='failed'>OPERATION FAILED</h2>";
            header("location:".SITEURL."admin/manage.delivery.php");
        }
    }

?>

<?php
    include('partials/footer.php');
?>