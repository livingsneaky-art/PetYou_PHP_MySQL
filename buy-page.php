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
                if (isset($_SESSION['event'])){
                    echo $_SESSION['event'];
                    unset($_SESSION['event']);
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
                <h2> Order Form</h2>
                <div class="input">
                    <div>
                        <label for="customer_name">Full Name</label>
                    </div>
                    <div>
                        <input type="text" name="customer_name">
                    </div>
                    <div>
                        <label for="customer_number">Contact Number</label>
                    </div>
                    <div>
                        <input type="text" name="customer_number">
                    </div>
                    <div>
                        <label for="customer_email">Email Address</label>
                    </div>
                    <div>
                        <input type="email" name="customer_email">
                    </div>
                </div>
                <div class="input">
                    
                    Event Details

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
                    Time Start:
                    <input type="datetime-local" name="event_start">
                    Time End:
                    <input type="datetime-local" name="event_end">
                    <input type="text" name="event_address" placeholder="Address">                    
                     
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


