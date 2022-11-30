<?php
   ob_start();
    // include header.php file
    include ('partials/header.php');
?>

    <div class="main" style="height:100vh;">

        <div class="container">
            <h1>UPDATE DELIVERY DETAILS</h1>

            <?php
                //Get id to be edit
                $id = $_GET['id'];
                $cart = $_GET['cart'];
                //SQL query to get data
                $sql = "SELECT * FROM delivery_details WHERE id = ?;";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();
                $row = $res->fetch_assoc();
                
                $id = $row['id'];
                $delivery = $row['delivery_type'];
                $start = $row['startTime'];
                $end = $row['endTime'];
                $deliveryAddress = $row['deliveryAddress'];

                $sql_2 = "SELECT * FROM type_delivery WHERE id = ?;";

                $stmt_2 = $conn->prepare($sql_2);
                $stmt_2->bind_param("i", $delivery);
                $stmt_2->execute();
                $res_2 = $stmt_2->get_result();
                $row_2 = $res_2->fetch_assoc();
                $delivery_id = $row_2['id'];
                $delivery_title = $row_2['title'];
            ?>
            <a href="<?php echo SITEURL; ?>admin/update.carts.php?id=<?php echo $cart; ?>" class="btn-blue btn">Back to cart details</a>
            <br><br>
            <form action="" method="POST" class="form">
               <div>
                    <label for="delivery">delivery Type:</label>
                    <p><?php echo $delivery_title; ?></p>
                    <p>Change to:</p>
                    <select name="delivery">
                        <option default value="<?php echo $delivery_id; ?>"></option>
                        <?php
                            //to get data from database
                            $sql = "SELECT * FROM type_delivery;";
                            //execute the query
                            $res = $conn->query($sql);
                            //count rows
                            $count = $res->num_rows;

                            if($count > 0){
                                while($row = $res->fetch_assoc()){
                                    $title = $row['title'];
                                    $e_id = $row['id'];
                        ?>
                            <option value="<?php echo $e_id; ?>"><?php echo $title; ?></option>
                            <?php 
                                }
                            } 
                        ?>
                    </select>  
               </div>
               <div>
                    <label for="start">Time Start:</label>
                    <p><?php echo $start; ?></p>
                    <p>Change to:</p>
                    <input type="datetime-local" name="start" value="<?php echo $start; ?>">  
               </div>
               <div>
                    <label for="end">Time End:</label>
                    <p><?php echo $end; ?></p>
                    <p>Change to:</p>
                    <input type="datetime-local" name="end" value="<?php echo $end; ?>">  
               </div>
               <div>
                    <label for="address">Address:</label>
                    <input type="text" name="address" value="<?php echo $deliveryAddress; ?>">  
               </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
               <button class="button" type="submit" name="submit">Submit</button>
           </form>
        </div>
    </div>

<?php

    if (isset($_POST['submit'])){
        $id = $_POST['id'];
        $delivery = $_POST['delivery'];
        $deliveryAddress = $_POST['address'];

        if ($_POST['start']){
            $start = $_POST['start'];
        }

        if ($_POST['end']){
            $end = $_POST['end'];
        }

        //SQL query to to update admin
        $sql = "UPDATE delivery_details
            SET 
            delivery_type = '$delivery',
            startTime = '$start',
            endTime = '$end',
            deliveryAddress = '$deliveryAddress'
            WHERE id = $id;";

        //to execute the query

        $res = $conn->query($sql);

        if ($res == TRUE){
            $_SESSION['update-delivery'] = "<h2 class='success'>UPDATE SUCCESSFUL</h2>";
            header("location:".SITEURL."admin/manage.carts.php");
        } else {
            $_SESSION['update-delivery'] = "<h2 class='failed'>UPDATE FAILED</h2>";
            header("location:".SITEURL."admin/manage.carts.php");
        }
    }
    
?>

<?php
    include('partials/footer.php');
?>