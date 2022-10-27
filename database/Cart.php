<?php

// php cart class
class Cart
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    // insert into cart table
    public  function insertIntoCart($params = null, $table = "bridge"){
        if ($this->db->con != null){
            if ($params != null){
                // "Insert into cart(user_id) values (0)"
                // get table columns
                $columns = implode(',', array_keys($params));

                $values = implode(',' , array_values($params));

                // create sql query
                $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);

                // execute query
                $result = $this->db->con->query($query_string);
                return $result;
            }
        }
    }

    // to get user_id and item_id and insert into cart table
    public  function addToCart($userid, $itemid){
        if (isset($userid) && isset($itemid)){
            $params = array(
                "userID" => $userid,
                "productID" => $itemid
            );
            $sql = "SELECT * FROM bridge WHERE userID = $userid AND productID = $itemid";
            $res = $this->db->con->query($sql);
            $count = mysqli_num_rows($res);
            while($row = $res->fetch_assoc()){
                $productID = $row['productID'];
            }
            if($count == 0){
                // insert data into cart
                $result = $this->insertIntoCart($params);
                if ($result){
                    // reload page
                    //header("Location:" . $_SERVER['PHP_SELF']);
                }
            }else{
                echo "<script>alert('Product is already in the cart!')</script>";
                echo "<script>window.location = 'header-customer_product.php'</script>";
            }
        }
    }

    // delete cart item using cart item id
    public function deleteCart($item_id = null, $table = 'bridge'){
        if($item_id != null){
            $result = $this->db->con->query("DELETE FROM {$table} WHERE productID={$item_id}");
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    // calculate sub total
    public function getSum($arr){
        if(isset($arr)){
            $sum = 0;
            foreach ($arr as $item){
                $sum += floatval($item[0]);
            }
            return sprintf('%.2f' , $sum);
        }
    }

    // get item_it of shopping cart list
    public function getCartId($cartArray = null, $key = "productID"){
        if ($cartArray != null){
            $cart_id = array_map(function ($value) use($key){
                return $value[$key];
            }, $cartArray);
            return $cart_id;
        }
    }

    // Save for later
    public function saveForLater($item_id = null, $saveTable = "wishlist", $fromTable = "bridge"){
        if ($item_id != null){
            $query = "INSERT INTO {$saveTable} SELECT * FROM {$fromTable} WHERE productID={$item_id};";
            $query .= "DELETE FROM {$fromTable} WHERE productID={$item_id};";

            // execute multiple query
            $result = $this->db->con->multi_query($query);

            if($result){
                header("Location :" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }


}