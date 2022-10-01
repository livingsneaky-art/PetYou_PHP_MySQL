<?php
   ob_start();
    // include header.php file
    include ('partials/header.php');
?>
    <div class="main" style="height:100vh;">

        <div class="container">
            <h1>UPDATE DELIVERY</h1>

            <?php
                //Get id to be edit
                $id = $_GET['id'];
                //SQL query to get data
                $sql = "SELECT * FROM type_delivery WHERE id = $id;";

                //To execute the query
                $res = $conn->query($sql);

                if ($res == TRUE){
                    $count = $res->num_rows;

                    if($count == 1){
                        $row = $res->fetch_assoc();
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                    } else {
                        header('location:'.SITEURL.'admin/manage.delivery.php');
                    }
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
               <div>
                    <label for="title">Event Name:</label>
                    <input type="text" name="title" value="<?php echo $title; ?>">  
               </div>
               <div>
                    Current Image:
                    <?php
                        if ($current_image != ""){
                            ?>
                            <img src="<?php echo SITEURL; ?>images/delivery/<?php echo $current_image; ?>" alt="" width="100px">
                          
               </div>
               <div>
                    <label for="image">New Image:</label>
                    <input type="file" name="image">  
               </div>
               <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
               <input type="hidden" name="id" value="<?php echo $id; ?>">
               <button class="button" type="submit" name="submit">Submit</button>
           </form>
        </div>
    </div>

<?php
                        }

    if (isset($_POST['submit'])){
        $title = $_POST['title'];
        $id = $_POST['id'];
        $current_image = $_POST['current_image'];

        //for image
        if (isset($_FILES['image']['name'])){
            //for image name
            $image_name = $_FILES['image']['name'];

            if ($image_name != ""){
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
                    header("location:".SITEURL."admin/manage.delivery.php");

                    die();
                }

                if ($current_image != ""){
                    //remove current image
                    $remove_path = "../images/delivery/".$current_image;

                    $remove = unlink($remove_path);

                    if ($remove == FALSE){
                        $_SESSION['upload'] = "<h2 class='failed'>REPLACE IMAGE FAILED</h2>";
                        header("location:".SITEURL."admin/manage.delivery.php");

                        die();

                    }
                }
            } else {
                $image_name = $current_image;
            }
        } else {
            $image_name = $current_image;
        }

        //SQL query to to update
        $sql = "UPDATE type_delivery
            SET title = '$title',
            image_name = '$image_name'
            WHERE id = '$id';";

        //to execute the query

        $res = $conn->query($sql);

        if ($res == TRUE){
            $_SESSION['update'] = "<h2 class='success'>UPDATE SUCCESSFUL</h2>";
            header("location:".SITEURL."admin/manage.delivery.php");
        } else {
            $_SESSION['update'] = "<h2 class='failed'>UPDATE FAILED</h2>";
            header("location:".SITEURL."admin/manage.delivery.php");
        }
    }
    
?>

<?php
    include('partials/footer.php');
?>