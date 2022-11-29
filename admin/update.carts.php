<?php
    ob_start();
    // include header.php file
    include ('partials/header.php');
?>
<div class="main">
<div class="container">
    <h1>UPDATE ORDER</h1>
    <br>
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
       <div style="display:flex;">
            <label>Delivery ID: &nbsp;</label>
            <p><?php echo $delivery; ?></p>  
       </div>
       <div style="display:flex;">
            <label for="name">Customer Name: &nbsp;</label>
            <p><?php echo $customer_name; ?><p>
       </div>
       <div style="display:flex;">
            <label for="number">Customer Number: &nbsp;</label>
            <p><?php echo $customer_contact_no; ?><p>  
       </div>
       <div style="display:flex;">
            <label for="email">Customer Email: &nbsp;</label>
            <p><?php echo $customer_email; ?></p>  
       </div>
       <div style="display:flex;">
            <label for="email">Delivery Address: &nbsp;</label>
            <p><?php echo $customer_email; ?></p>  
       </div>
       <div style="display:flex;">
            <label for="receipt">Receipt ID: &nbsp;</label>
            <p><?php echo $receipt; ?></p>  
       </div>
       <div style="display:flex;">
            <label for="receipt">Product Total: &nbsp;</label>
            <p><?php echo $receipt;?></p>  
       </div>
       <div>
            <label for="status">Order Status:</label>
            <select name="status">
                <option value="Processing">Processing</option>
                <option value="Successful">Successful</option>
                <option value="Cancelled">Cancelled</option>
            </select>
       </div>
       <div>
            <label for="delivery_status">Delivery Status:</label>
            <select name="delivery_status">
                <option value="To Be Shipped">To Be Shipped</option>
                <option value="Shipped">Shipped</option>
                <option value="Delivered">Delivered</option>
            </select>
       </div>
       <div>
            <label for="delivery_status">Estimated Date of Delivery:</label>
            <input type="datetime-local" name="deliverydate" value="<?php echo $delviery; ?>">
       </div>
       <div>
            <label for="payment">Payment Status:</label>
            <select name="payment">
                <option value="Paid">Paid</option>
                <option value="Refunded">Refunded</option>
            </select>
       </div>
       <br>
       
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <button class="btn btn-primary btn-outline-secondary" type="submit" name="submit">Update</button>
        <a href="<?php echo SITEURL; ?>admin/manage.carts.php" class="btn btn-dark btn-outline-dark">Cancel</a>
       <br><br>
    
   </form>
   <?php
        include ('update.orders.php');
   ?>
</div>
    </div>



<?php

if (isset($_POST['submit'])){
$id = $_POST['id'];
$customer_name = $_POST['name'];
$customer_contact_no = $_POST['number'];
$customer_email = $_POST['email'];
$status = $_POST['status'];
$payment_status = $_POST['payment_status'];
$delivery_status = $_POST['delivery_status'];


//SQL query to to update admin
$sql = "UPDATE cart
    SET customer_name = '$customer_name',
    customer_contact_no = '$customer_contact_no',
    customer_email = '$customer_email',
    status = '$status',
    delivery_status = '$delivery_status',
    payment_status = '$payment_status'
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

