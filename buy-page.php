<?php
ob_start();
// include header.php file
include ('header.php');
?>
  <!---main section--->
  <div style="background-color:#F7DAD9; height:100%; padding-top:1em; padding-bottom:1em;">
    <br>
        <center>

<?php 
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM user WHERE id = $id";
    $res = $conn->query($sql) or die(mysqli_error($conn));
    if($res == TRUE){
        $count = mysqli_num_rows($res);

        if($count == 1){
            $row = mysqli_fetch_assoc($res);
            $fName = $row['fName'];
            $lName = $row['lName'];
            $customer_number = $row['customer_contact_no'];
            $customer_email = $row['customer_email'];
            //$delivery_start = $row['delivery_start'];
            //$delivery_end = $row['delivery_end'];
            $Address = $row['deliveryAddress'];
        }
    }
    //$_POST['fName'] = $fName;
    //$_POST['lName'] = $lName;
    $_POST['customer_name'] = $fName.$lName;
    $_POST['customer_number'] = $customer_number;
    $_POST['customer_email'] = $customer_email;
    $_POST['delivery_address'] = $Address;

    include('order-form.php');

?>
</center>
        <div class="form-container">
            <form action="" method="POST" class="form-overlay">
            <?php
                if (isset($_SESSION['name'])){
                    echo $_SESSION['name'];
                    unset($_SESSION['name']);
                }

                if (isset($_SESSION['contacts'])){
                    echo $_SESSION['contacts'];
                    unset($_SESSION['contacts']);
                }
                if (isset($_SESSION['delivery'])){
                    echo $_SESSION['delivery'];
                    unset($_SESSION['delivery']);
                }
                if (isset($_SESSION['menu'])){
                    echo $_SESSION['menu'];
                    unset($_SESSION['menu']);
                }
                if (isset($_SESSION['book'])){
                    echo $_SESSION['book'];
                    unset($_SESSION['book']);
                }
            ?>
                
                <div class="input">
                    
                    delivery Details

                    <select name="delivery" id="">
                        <?php
                            //to get data from database
                            $sql = "SELECT * FROM type_delivery;";
                            //execute the query
                            $res = mysqli_query($conn, $sql);
                            //count rows
                            $count = mysqli_num_rows($res);

                            if($count > 0){
                                while($row = mysqli_fetch_assoc($res)){
                                    $title = $row['title'];
                                    $id = $row['id'];
                        ?>
                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                            <?php 
                                }
                            } 
                        ?>
                    </select>
                                   
                     
                </div>

                <!-----MENUS CHOICES------->
                <h2>Menus</h2>
                <div class="input">
                
                    <div class="grid-container">
                        
                        <?php
                            //to get data from database
                            $sql = "SELECT * FROM product;";
                            //execute the query
                            $res = mysqli_query($conn, $sql);
                            //count rows
                            $count = mysqli_num_rows($res);

                            if($count > 0){
                                while($row = mysqli_fetch_assoc($res)){
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    $image_name = $row['image'];
                                    $descritpion = $row['description'];
                                    $price = $row['price'];
                        ?>
                            <div class="center">
                                <img src="<?php echo SITEURL; ?>images/product/<?php echo $image_name; ?>" alt="" width="100px" height="200px">
                                <div>
                                    <h3><?php echo $title ?></h3>
                                    <p class="desc"><?php echo $descritpion; ?></p>
                                    <p><?php echo $price; ?></p>
                                </div>
                                <input type="checkbox" name="product[]" value="<?php echo $id; ?>">
                                <br>
                                Quantity:
                                <input type="number" name="product_qty[<?php echo $id; ?>]" min="1" max="10">
                                
                            </div>
                            <?php 
                                }
                            }
                        ?>
                            
                    </div>
                </div>

               
           
                <center style="margin-top: 20px;">
                   <button class="button" type="submit" name="submit" >Submit</button> 
     
                </center>
                
            </form>
        </div>
    </div>


<?php
// include footer.php file
include ('footer.php');
?>


