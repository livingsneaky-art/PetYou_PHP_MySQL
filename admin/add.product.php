<?php
   ob_start();
    // include header.php file
    include ('partials/header.php');
?>

    <!---main section--->

    <div class="main">
        <div class="add-body" style="height:70vh">
            <div class="container">
                <h1>ADD PRODUCTS</h1>

                <?php
                    if (isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                ?>
                <div class="d-flex justify-content-center container ">
                    <form action="" method="POST" class="form shadow card bg-light border border-outline-light px-3 py-3" enctype="multipart/form-data">
                        <div>
                                <label for="title" class="form-label">Menu Name:</label>
                                <input type="text" class="form-control" name="title">  
                        </div>
                        <div>
                                <label for="description" class="form-label"><Menu></Menu> Description:</label>
                                <input type="text" class="form-control" name="description">  
                        </div>
                        <div>
                                <label for="price" class="form-label">Price:</label>
                                <input type="text" class="form-control" name="price">  
                        </div>
                        <div>
                                <label for="image" class="form-label">Image:</label>
                                <input type="file" class="form-control" name="image">  
                        </div>
                        
                        <button class="button my-3 mx-4" type="submit" name="submit">Submit</button>
                        <a href="manage.products.php" class="btn btn-dark btn-outline-dark round mx-4">Cancel</a>
                    </form>
                </div>  
            </div>
        </div>
        <div class="mt-4"></div>           
    </div>
<?php

    if(isset($_POST['submit'])){

        //get data from form
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        //for image file
        if(isset($_FILES['image']['name'])){
            //for image name
            $image_name = $_FILES['image']['name'];
            ///to rename the image
            $ext = end(explode('.', $image_name));
            $image_name = "Product_.".rand(000, 999).'.'.$ext;
            //for image source
            $source = $_FILES['image']['tmp_name'];
            //destination
            $dest = "../images/product/".$image_name;
            //to upload the image
            $upload = move_uploaded_file($source, $dest);

            if($upload == FALSE){
                $_SESSION['upload'] = "<h2 class='failed'>UPLOAD IMAGE FAILED</h2>";
                header("location:".SITEURL."admin/add.product.php");

                die();
            }
        } else {
            $image_name = "";
        }

        //SQL query to insert to database
        $sql = "INSERT INTO product (title, description, price, image) VALUES ('$title', '$description', '$price', '$image_name');";

        //execute the query
        $res = $conn->query($sql);

        if ($res == TRUE){
            $_SESSION['add'] = "<h2 class='success'>OPERATION SUCCESSFUL</h2>";
            header("location:".SITEURL."admin/manage.products.php");
        } else {
            $_SESSION['add'] = "<h2 class='failed'>OPERATION FAILED</h2>";
            header("location:".SITEURL."admin/manage.products.php");
        }
    }

?>
    
<?php
    include('partials/footer.php');
?>