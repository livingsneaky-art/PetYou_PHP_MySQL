<?php
    ob_start();
    // include header.php file
    include ('partials/header.php');
?>
    <div class="main" style="height:100vh;">

<div class="container">
    <!-- <h1>UPDATE PURCHASE</h1> -->

    <?php
        //Get id of admin to be edit
        $id = $_GET['id'];
        //SQL query to get data
        $sql = "SELECT * FROM payment_details pd, cart c WHERE pd.id = c.receiptID AND c.id = $id;";

        //To execute the query
        $res = $conn->query($sql);

        if ($res == TRUE){
            $count = $res->num_rows;

            if($count == 1){
                $row = $res->fetch_assoc();
                $total = $row['products_total'];
                $name = $row['customer_name'];
                $email = $row['customer_email'];
                $number = $row['customer_contact_no'];
            } else {
                header('location:'.SITEURL.'admin/manage.purchase.php');
            }
        }
    ?>

     <!-- FORM TO UPDATE USER -->
     <div class=" align-items-center d-flex justify-content-center container">
                <form action="" method="POST" class="form card mt-4 bg-light border border-outline-light px-3 py-3" style="width: 20rem;">
                    <div class="card-header bg-light h4 text-center fw-bold ">Update Purchase</div>
                        <div class="row">
                            <!-- PRODUCT TOTAL -->
                            <div class="mt-4">
                                    <label for="total" class="form-label">Product Total</label>
                                    <input type="text" name="total" class="form-control" value="<?php echo $total; ?>" required>  
                            </div>
                            <!-- NAME -->
                            <div class="mt-4">
                                    <label for="name" class="form-label">Customer Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>  
                            </div>
                            <!-- NAME -->
                            <div class="mt-4">
                                    <label for="email" class="form-label">Customer Email</label>
                                    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" required>  
                            </div>
                            <!-- NAME -->
                            <div class="mt-4">
                                    <label for="number" class="form-label">Customer Contact #</label>
                                    <input type="text" name="number" class="form-control" value="<?php echo $number; ?>" required>  
                            </div>
                            <!-- UPDATE USER BUTTON -->
                            <div class="mt-4 text-center">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button class="btn btn-primary btn-outline-secondary" type="submit" name="submit">Update</button>
                                <a href="manage.purchase.php" class="btn btn-dark btn-outline-dark">Cancel</a>
                            </div>
                        
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </div>

<?php

if (isset($_POST['submit'])){
$id = $_POST['id'];
$total = $_POST['total'];
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];

//SQL query to to update admin
$sql = "UPDATE payment_details pd, cart c 
SET pd.products_total = '$total', c.customer_name = '$name', c.customer_email = '$email', c.customer_contact_no = '$number' 
WHERE pd.id = c.receiptID AND c.id = $id;";


//to execute the query
$res = $conn->query($sql);

if ($res == TRUE){
    $_SESSION['update'] = "<h2 class='success'>UPDATE SUCCESSFUL</h2>";
    header("location:".SITEURL."admin/manage.purchase.php");
} else {
    $_SESSION['update'] = "<h2 class='failed'>UPDATE FAILED</h2>";
    header("location:".SITEURL."admin/manage.purchase.php");
}
}

?>

<?php
    include ('partials/footer.php');
?>