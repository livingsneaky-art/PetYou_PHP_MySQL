<?php
    ob_start();
    // include header.php file
    include ('partials/header.php');
?>
   <div class="main" style="height:100vh;">

<div class="container">
    <h1>UPDATE CART</h1>
    <a href="<?php echo SITEURL; ?>admin/manage.carts.php" class="btn-blue btn">Back to Carts</a>
    <br><br>
    <?php
        //Get id to be edit
        $id = $_GET['id'];
        //SQL query to get data
        $sql = "SELECT * FROM cart WHERE id = $id;";

        //To execute the query
        $res = mysqli_query($conn, $sql);

        if ($res == TRUE){
            $count = mysqli_num_rows($res);

            if($count == 1){
                $row = mysqli_fetch_assoc($res);
                $delivery = $row['deliveryID'];
                $customer_name = $row['customer_name'];
                $customer_contact_no = $row['customer_contact_no'];
                $customer_email = $row['customer_email'];
                $receipt = $row['receiptID'];
                $status = $row['status'];

            } else {
                header('location:'.SITEURL.'admin/manage.carts.php');
            }
        }
    ?>

    <form action="" method="POST" class="form">
       <div>
            <label>delivery ID:</label>
            <p><?php echo $delivery; ?></p>  
       </div>
       <div>
            <label for="name">Customer Name:</label>
            <input type="text" name="name" value="<?php echo $customer_name; ?>">  
       </div>
       <div>
            <label for="number">Customer Number:</label>
            <input type="text" name="number" value="<?php echo $customer_contact_no; ?>">  
       </div>
       <div>
            <label for="email">Customer Email:</label>
            <input type="email" name="email" value="<?php echo $customer_email; ?>">  
       </div>
       <div>
            <label for="receipt">Receipt:</label>
            <p><?php echo $receipt; ?></p>  
       </div>
       <div>
            <label for="status">Status:</label>
            <select name="status">
                <option value="Confirmed">Confirmed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
       </div>
       <div>
            <label for="delivery_status">delivery Status:</label>
            <select name="delivery_status">
                <option value="To Be Held">To Be Held</option>
                <option value="Finished">Finished</option>
            </select>
       </div>
       <div>
            <label for="transaction">Transaction Status:</label>
            <select name="transaction">
                <option value="Processing">Processing</option>
                <option value="Successful">Successful</option>
                <option value="Failed">Failed</option>
            </select>
       </div>
       
        <input type="hidden" name="id" value="<?php echo $id; ?>">
       <button class="button" type="submit" name="submit">Submit</button>
       <br><br>
       <a href="<?php echo SITEURL; ?>admin/update.delivery-details.php?id=<?php echo $delivery; ?>&cart=<?php echo $id; ?>" class="btn-blue btn">Go to delivery details</a>
       <br><br>
       <a href="<?php echo SITEURL; ?>admin/update.orders.php?cart=<?php echo $id; ?>" class="btn-blue btn">Go to order details</a>
       <br><br>
       <a href="<?php echo SITEURL; ?>admin/manage.men-pay-details.php?cart=<?php echo $id; ?>" class="btn-blue btn">Go to payment details</a>
   </form>
</div>
</div>


<?php

if (isset($_POST['submit'])){
$id = $_POST['id'];
$customer_name = $_POST['name'];
$customer_contact_no = $_POST['number'];
$customer_email = $_POST['email'];
$status = $_POST['status'];
$transaction = $_POST['transaction'];
$delivery_status = $_POST['delivery_status'];


//SQL query to to update admin
$sql = "UPDATE cart
    SET customer_name = '$customer_name',
    customer_contact_no = '$customer_contact_no',
    customer_email = '$customer_email',
    status = '$status',
    delivery_status = '$delivery_status',
    transaction_status = '$transaction'
    WHERE id = '$id;'";

//to execute the query

$res = mysqli_query($conn, $sql);

if ($res == TRUE){
    $_SESSION['update'] = "<h2 class='success'>UPDATE SUCCESSFUL</h2>";
    header("location:".SITEURL."admin/manage.carts.php");
} else {
    $_SESSION['update'] = "<h2 class='failed'>UPDATE FAILED</h2>";
    header("location:".SITEURL."admin/manage.carts.php");
}
}

?>

<?php
    include ('partials/footer.php');
?>