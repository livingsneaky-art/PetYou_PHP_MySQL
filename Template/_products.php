<!--   product  -->
<?php
    $id = $_SESSION['id'];
   
    $sql = "SELECT * FROM user WHERE userID=$id";
    $res = $conn->query($sql) or die(mysqli_error($conn));;
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
    
   
    if(isset($_POST['submit'])){
        //assign values
        $customer_name = $_POST['customer_name'];
        $customer_number = $_POST['customer_number'];
        $customer_email = $_POST['customer_email'];
        $delivery_type = $_POST['delivery'];
        //$start = mysqli_real_escape_string($conn, $_POST['delivery_start']);
        //$end = mysqli_real_escape_string($conn, $_POST['delivery_end']);
        $address =  $_POST['delivery_address'];
        $product_qty = $_POST['product_qty'];
        $cart_id = rand(000, 999);
        $delivery_id = rand(000, 999);
        $payment_id = rand(000, 999);
        
     
    
         ////for storing delivery details to delivery_details table
        $query = "INSERT INTO delivery_details
            SET id = ?,
            deliveryID = ?,
            deliveryAddress = ?,
            delivery_type = (
                SELECT id 
                FROM type_delivery
                WHERE id = ?);";
    
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iisi",$delivery_id, $delivery_id, $address, $delivery_type);
        $res_delivery = $stmt->execute();
    
        if (!$res_delivery){
            echo $conn->error;
        }
    
        //create cart record
        $query_2 = "INSERT INTO cart
            SET id = ?,
            customer_name = ?,
            customer_contact_no = ?,
            customer_email = ?,
            deliveryID = (
                SELECT id
                FROM delivery_details
                WHERE id = ?);";
    
        $stmt_2 = $conn->prepare($query_2);
        $stmt_2->bind_param("isssi", $cart_id, $customer_name, $customer_number, $customer_email, $delivery_id);
        $res_book = $stmt_2->execute();
        
        if (!$res_book){
            echo $conn->error;
        }
        
        //create product record
     
            $products = $_GET['productID'];
            
            $product_query = "INSERT INTO product_carts
                SET
                quantity = ?,
                cartID = (
                    SELECT id
                    FROM cart
                    WHERE id = ?),
                type = (
                    SELECT productID
                    FROM product
                    WHERE productID = ?);";
    
            $product_stmt = $conn->prepare($product_query);
            $product_stmt->bind_param("iii", $product_qty, $cart_id, $products);
            $res_product = $product_stmt->execute();
           
            if(!$res_product){
                echo $conn->error;
            }
        
        
        //create payment record
    
        //calculate fees
        $product_sql = "SELECT SUM(mt.price * mb.quantity) as 'product total'
        FROM product mt, product_carts mb
        WHERE mt.productID = mb.type
        AND mb.cartID = ?;";
    
        $stmt_product = $conn->prepare($product_sql);
        $stmt_product->bind_param("i", $cart_id);
        $stmt_product->execute();
        $result_product = $stmt_product->get_result();
        $row_product = $result_product->fetch_assoc();
        $product_total = $row_product['product total'];
    
    
        $total = $product_total;
        $min = $total * .50;
    
        //create payment details
        $query_pay = "INSERT INTO payment_details
            SET id = ?,
            products_total = ?,
            total = ?,
            balance = ?,
            minPayment = ?;
          ";
    
        $stmt_pay = $conn->prepare($query_pay);
        $stmt_pay->bind_param("iiiii", $payment_id, $product_total, $total, $total, $min);
        $res_pay = $stmt_pay->execute();
    
        if(!$res_pay){
            echo $conn->error;
        } 
    
        //add receipt to cart record
        $query_cart = "UPDATE cart
            SET receiptID = (
                SELECT id 
                FROM payment_details
                WHERE id = ?)
            WHERE id = ?;
          ";
    
        $stmt_carts = $conn->prepare($query_cart);
        $stmt_carts->bind_param("ii", $payment_id, $cart_id);
        $res_carts = $stmt_carts->execute();
       
        if ($res_carts){
            $_SESSION['cart_id'] = $cart_id;
           echo " <center><h2 class='success'>TRANSACT SUCCESSFUL.</h2> </center>";
    
           //echo "<a class='btn btn-blue' href='payment.php'>Check your order.</a>" ;
         
            
        }else {
           echo "<h2 class='failed'>cart FAILED</h2>";
        }
    }
            
          

    $item_id = $_GET['productID'] ?? 1;
    foreach ($product->getData() as $item) :
        if ($item['productID'] == $item_id) :

          
           
?>
<section id="product" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <img src="<?php echo SITEURL; ?>images/product/<?php echo $item['image']; ?>" alt=""  class="img-fluid">
                <form action="product.php" method="POST">   
              
                <div class="form-row pt-4 font-size-16 font-baloo">
                    <div class="col">
                    <input type="hidden" name="productID" value="<?php echo $item['productID'] ?? '1'; ?>">
                        <?php
                        if (in_array($item['productID'], $Cart->getCartId($product->getData('bridge')) ?? [])){
                            echo '<button type="submit" disabled class="btn btn-success font-size-16 form-control">In the Cart</button>';
                        }else{
                            echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-16 form-control">Add to Cart</button>';
                        }
                        ?>
                    </div>
                </div>
                <div style="padding-top: 50px;">
                    
                </div>
            </div>
            <div class="col-sm-6 py-5">
                <h5 class="font-baloo font-size-20"><?php echo $item['title'] ?? "Unknown"; ?></h5>
                <small>by <?php echo $item['item_brand'] ?? "LRK"; ?></small>
                <div class="d-flex">
                    <div class="rating text-warning font-size-12">
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="far fa-star"></i></span>
                    </div>
                    <a href="#" class="px-2 font-rale font-size-14">20,534 ratings</a>
                </div>
                <hr class="m-0">

                <!---    product price       -->
                <table class="my-3">
                    <tr class="font-rale font-size-14">
                        <td>Deal Price:</td>
                        <td class="font-size-20 text-danger">$<span><?php echo $item['price'] ?? 0; ?></span><small class="text-dark font-size-12">&nbsp;&nbsp;Inclusive of all taxes</small></td>
                    </tr>
                </table>
                <!---    !product price       -->

                <!--    #policy -->
                <div id="policy">
                <div class="input">
                    
                <hr>

                <!-- order-details -->
                <div id="order-details" class="font-rale d-flex flex-column text-dark">
                    <small>Sold by <a href="#">LKR </a></small>
                </div>
                <!-- !order-details -->

                <div class="row">
                    <div class="col-6">
                         <!-- product qty section -->
                         <!-- product qty section -->
                    </div>
                </div>
                </div>
                </form>
            </div>    
        </div>
        <div class="col-12">
            <h6 class="font-rubik">Product Description</h6>
            <?php echo $item['description'] ?? "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat inventore vero numquam error est ipsa, consequuntur temporibus debitis nobis sit, delectus officia ducimus dolorum sed corrupti. Sapiente optio sunt provident, accusantium eligendi eius reiciendis animi? Laboriosam, optio qui? Numquam, quo fuga. Maiores minus, accusantium velit numquam a aliquam vitae vel?"; ?>
        </div>
    </div>
</section>
<!--   !product  -->

<?php
 
 //include('order-form.php');  
// header('location: localhost/petyou/payment.php');
        endif;
        endforeach;
       
  
        

?>
