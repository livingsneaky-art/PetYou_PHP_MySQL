<?php
    ob_start();
    // include header.php file
    include ('partials/header.php');
?>
 <!---main section--->
 <div class="main" style="height:100vh;">
        <div class="container">
            <h2 class="mb-5">DISCOUNTS</h2>

            <?php
                if (isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if (isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if (isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if (isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }

                if (isset($_SESSION['pwd-not-match'])){
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']);
                }

                if (isset($_SESSION['pwd-changed'])){
                    echo $_SESSION['pwd-changed'];
                    unset($_SESSION['pwd-changed']);
                }
            ?>

            <table class="tbl-full table mt-4" style="height:auto;">
                <thead class="thead-light">
                <tr>
                    <th scope="col">DiscountA</th>
                    <th scope="col">DiscountB</th>
                    <th scope="col">DiscountC</th>
                    <th scope="col">DiscountD</th>
                    <th scope="col"></th>
                    <!-- <th scope="col"></th>
                    <th scope="col"></th> -->
                </tr>
                </thead>

                <tbody>

                <?php
                    //TO GET DATA
                    $sql = "SELECT * FROM discount";
                    //CATCHER
                    $res = $conn->query($sql);

                    if ($res == TRUE){
                        // PRESENT ROWS
                        $count = $res->num_rows;

                        if ($count > 0){
                            //Loop through data
                            while($rows = $res->fetch_assoc()){
                                $id = $rows['discountID'];
                                $discountA = $rows['discountA'];
                                $discountB = $rows['discountB'];
                                $discountC = $rows['discountC'];
                                $discountD = $rows['discountD'];
                                ?>

                                <tr>
                                    <td scope="row"><?php echo $discountA; ?>%</td>
                                    <td scope="row"><?php echo $discountB; ?>%</td>
                                    <td scope="row"><?php echo $discountC; ?>%</td>
                                    <td scope="row"><?php echo $discountD; ?>%</td>
                                    <td scope="row" class="btn-st">
                                        
                                       <!-- <a href="<?php// echo SITEURL; ?>admin/update.discount.php" class=""><img src="../assets/admin/edit.png" alt="Edit user" style="width: 35px;" class="mr-3"></a>-->
                                       
                                    </td>
                                </tr>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal_<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        Are you sure you want to delete this user?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <!-- <button type="button" class="btn btn-danger">Delete</button> -->
                                            <a href="<?php echo SITEURL; ?>admin/delete.admin.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                    } else {

                    }

                ?>

            </table>

        </div>
        
    </div>

<?php
    include ('partials/footer.php');
?>