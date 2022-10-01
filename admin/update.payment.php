<?php
   ob_start();
    // include header.php file
    include ('partials/header.php');
?>

    <div class="main" style="height:100vh;">

        <div class="container">
            <h1>UPDATE PAYMENT DETAILS</h1>

            <?php
                //Get id to be edit
                $cart = $_GET['id'];
                //SQL query to get data
                $sql = "SELECT * FROM payment_details
                    WHERE id = (
                        SELECT receiptID
                        FROM cart
                        WHERE id = $cart);";

                $res = mysqli_query($conn, $sql);

                    if ($res == TRUE){
                        // PRESENT ROWS
                        $count = mysqli_num_rows($res);

                        if ($count > 0){
                            //Loop through data
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $product = $rows['products_total'];
                                $min = $rows['minPayment'];
                                $paid = $rows['paid'];
                                $balance = $rows['balance'];
                                $status = $rows['status'];
                                $total = $rows['total'];

                                ?>

            <form action="" method="POST" class="form">
               <div>
                    <p>Total: <?php echo $total; ?></p>
                    <p>Minimum Payment: <?php echo $min; ?></p>
                    <p>Paid: <?php echo $paid; ?></p>
                    <p>Balance: <?php echo $balance; ?></p>
               </div>
               <div>
                    <label for="paid">Enter payment amount:</label>
                    <input type="number" name="payment" value="<?php echo $payment; ?>">  
               </div>
               <div>
                   <label for="status">Update status:</label>
                   <select name="status">
                        <option value="Unpaid">Unpaid</option>
                        <option value="Partially paid">Partially paid</option>
                        <option value="Fully paid">Fully Paid</option>
                    </select>
               </div>
                <input type="hidden" name="id" value="<?php echo $cart; ?>">
                <input type="hidden" name="balance" value="<?php echo $balance; ?>">
                <input type="hidden" name="paid" value="<?php echo $paid; ?>">
               <button class="button" type="submit" name="submit">Submit</button>
           </form>

           <?php
                            }
                        }
                    } else {

                    }

                ?>

        </div>
    </div>

<?php

    if (isset($_POST['submit'])){
        $cart = $_POST['id'];
        $balance = $_POST['balance'];
        $status = $_POST['status'];
        $paid = $_POST['paid'];  

        if ($_POST['payment']){
            $payment = $_POST['payment'];
        }  

        $amount = $paid + $payment;

        //SQL query to to update admin
        $sql = "UPDATE payment_details
            SET 
            paid = $amount,
            balance = ($balance - $payment),
            status = '$status'
            WHERE id = (
                SELECT receiptID
                FROM cart
                WHERE id = $cart);";

        //to execute the query

        $res = mysqli_query($conn, $sql);

        if ($res == TRUE){
            $_SESSION['update-payment'] = "<h2 class='success'>UPDATE PAYMENT SUCCESSFUL</h2>";
            header("location:".SITEURL."admin/manage.men-pay-details.php?cart=$cart");
        } else {
            $_SESSION['update-payment'] = "<h2 class='failed'>UPDATE PAYMENT FAILED</h2>";
            header("location:".SITEURL."admin/manage.men-pay-details.php?cart=$cart");
        }
    }
    
?>

<?php
    include('partials/footer.php');
?>