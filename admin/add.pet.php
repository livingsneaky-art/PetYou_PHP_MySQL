<?php
   ob_start();
    // include header.php file
    include ('partials/header.php');
?>

    <!---main section--->

    <div class="main">
        <div class="add-body" style="height:57.6vh">
            <div class="container">
                <center><h1>ADD PET</h1></center>

            <?php
                    if (isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                ?>

                <div class="d-flex justify-content-center container">
                    <form action="" method="POST" class="form shadow card bg-light border border-outline-light px-3 py-3" enctype="multipart/form-data">
                        <div>
                                <label for="petName" class="form-label">Pet Name:</label>
                                <input type="text" name="petName" class="form-control" required>  
                        </div>
                        <div>
                                <label for="description" class="form-label"><Menu></Menu> Description:</label>
                                <input type="text" name="description" class="form-control" required>  
                        </div>
                        <div>
                                <label for="price" class="form-label">Price:</label>
                                <input type="text" name="price" class="form-control" required>  
                        </div>
                        <div>
                                <label for="image" class="form-label">Image:</label>
                                <input type="file" name="image" class="form-control" required>  
                        </div>
                        
                        <button class="button my-3 mx-4" type="submit" name="submit">Add</button>
                        <a href="manage.adoption.php" class="btn btn-dark btn-outline-dark round mx-4">Cancel</a>
                    </form>
                </div>
                
            </div>
        </div>

    </div>
<?php

    if(isset($_POST['submit'])){

        //get data from form
        $name = $_POST['petName'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        //for image file
        if(isset($_FILES['image']['name'])){
            //for image name
            $image_name = $_FILES['image']['name'];
            ///to rename the image
            $ext = end(explode('.', $image_name));
            $image_name = "Pet.".rand(000, 999).'.'.$ext;
            //for image source
            $source = $_FILES['image']['tmp_name'];
            //destination
            $dest = "../images/product/".$image_name;
            //to upload the image
            $upload = move_uploaded_file($source, $dest);

            if($upload == FALSE){
                $_SESSION['upload'] = "<h2 class='failed'>UPLOAD IMAGE FAILED</h2>";
                header("location:".SITEURL."admin/add.adoption.php");

                die();
            }
        } else {
            $image_name = "";
        }

        //SQL query to insert to database
        $sql = "INSERT INTO pet (petname, petdescription, price, image) VALUES ('$name', '$description', '$price', '$image_name');";

        //execute the query
        $res = $conn->query($sql);

        if ($res == TRUE){
            $_SESSION['add'] = "<h2 class='success'>OPERATION SUCCESSFUL</h2>";
            header("location:".SITEURL."admin/manage.adoption.php");
        } else {
            $_SESSION['add'] = "<h2 class='failed'>OPERATION FAILED</h2>";
            header("location:".SITEURL."admin/manage.adoption.php");
        }
    }

?>

<?php
    include('partials/footer.php');
?>