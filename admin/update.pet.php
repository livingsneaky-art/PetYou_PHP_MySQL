<?php
    ob_start();
    // include header.php file
    include ('partials/header.php');
?>
   <div class="main" style="height:100vh;">

<div class="container">
    <center><h1>UPDATE PET</h1></center>

    <?php
        //Get id to be edit
        $id = $_GET['id'];
        //SQL query to get data
        $sql = "SELECT * FROM pet WHERE petID = $id;";

        //To execute the query
        $res = $conn->query($sql);

        if ($res == TRUE){
            $count = $res->num_rows;

            if($count == 1){
                $row = $res->fetch_assoc();
                $name = $row['petname'];
                $description = $row['petdescription'];
                $price = $row['price'];
                $current_image = $row['image'];
            } else {
                header('location:'.SITEURL.'admin/manage.adoption.php');
            }
        }
    ?>

    <div class="d-flex justify-content-center container">
        <form action="" method="POST" enctype="multipart/form-data" class="form shadow card mt-4 bg-light border border-outline-light px-3 py-3">
        <div>
                <label for="petName" class="form-label">Pet Name:</label>
                <input type="text" name="petName" class="form-control" value="<?php echo $name; ?>">  
        </div>
        <div>
                <label for="description" class="form-label"><Menu></Menu> Description:</label>
                <input type="text" name="description" class="form-control" value="<?php echo $description; ?>">  
        </div>
        <div>
                <label for="price" class="form-label">Price:</label>
                <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">  
        </div>
        <div class="my-4">
                Current Image:
                <?php
                    if ($current_image != ""){
                        ?>
                        <img src="<?php echo SITEURL; ?>images/product/<?php echo $current_image; ?>" alt="" width="100px">
                    
        </div>
        <div>
                <label for="image" class="form-label">New Image:</label>
                <input type="file" name="image" class="form-control">  
        </div>
        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button class="button my-3" type="submit" name="submit">Update</button>
        <a href="manage.adoption.php" class="btn btn-dark btn-outline-dark round">Cancel</a>
    </form>
    </div>
    
</div>
</div>

<?php
                }

if (isset($_POST['submit'])){
$name = $_POST['petName'];
$description = $_POST['description'];
$price = $_POST['price'];
$id = $_POST['id'];
$current_image = $_POST['current_image'];

//for image
if (isset($_FILES['image']['name'])){
    //for image name
    $image_name = $_FILES['image']['name'];

    if ($image_name != ""){
        ///to rename the image
        $ext = end(explode('.', $image_name));
        $image_name = "Pet_".rand(000, 999).'.'.$ext;
        //for image source
        $source = $_FILES['image']['tmp_name'];
        //destination
        $dest = "../images/product/".$image_name;
        //to upload the image
        $upload = move_uploaded_file($source, $dest);

        if($upload == FALSE){
            $_SESSION['upload'] = "<h2 class='failed'>UPLOAD IMAGE FAILED</h2>";
            header("location:".SITEURL."admin/manage.adoption.php");

            die();
        }

        if ($current_image != ""){
            //remove current image
            $remove_path = "../images/product/".$current_image;

            $remove = unlink($remove_path);

            if ($remove == FALSE){
                $_SESSION['upload'] = "<h2 class='failed'>REPLACE IMAGE FAILED</h2>";
                header("location:".SITEURL."admin/manage.adoption.php");

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
$sql = "UPDATE pet
    SET petname = '$name',
    petdescription = '$description',
    price = '$price',
    image = '$image_name'
    WHERE petID = '$id';";

//to execute the query

$res = $conn->query($sql);

if ($res == TRUE){
    $_SESSION['update'] = "<h2 class='success'>UPDATE SUCCESSFUL</h2>";
    header("location:".SITEURL."admin/manage.adoption.php");
} else {
    $_SESSION['update'] = "<h2 class='failed'>UPDATE FAILED</h2>";
    header("location:".SITEURL."admin/manage.adoption.php");
}
}

?>
<?php
    include ('partials/footer.php');
?>