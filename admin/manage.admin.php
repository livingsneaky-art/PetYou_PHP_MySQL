<?php
    ob_start();
    // include header.php file
    include ('partials/header.php');
?>
 <!---main section--->
 <div class="main" style="height:100vh;">
        <div class="container">
            <h2 class="mb-5">MANAGE ADMIN</h2>

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

            <a href="add.admin.php" class="button"><i class="fa fa-plus" aria-hidden="true"></i> ADD ADMIN</a>

            <table class="tbl-full table mt-4" style="height:auto;">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>
                    <th scope="col"></th>
                    <!-- <th scope="col"></th>
                    <th scope="col"></th> -->
                </tr>
                </thead>

                <tbody>

                <?php
                    //TO GET DATA
                    $sql = "SELECT * FROM user;";
                    //CATCHER
                    $res = $conn->query($sql);

                    if ($res == TRUE){
                        // PRESENT ROWS
                        $count = $res->num_rows;

                        if ($count > 0){
                            //Loop through data
                            while($rows = $res->fetch_assoc()){
                                $id = $rows['userID'];
                                $fName = $rows['fName'];
                                $lName = $rows['lName'];
                                $username = $rows['uName'];

                                ?>

                                <tr>
                                    <td scope="row"><?php echo $id; ?></td>
                                    <td scope="row"><?php echo $fName; ?></td>
                                    <td scope="row"><?php echo $lName; ?></td>
                                    <td scope="row"><?php echo $username; ?></td>
                                    <td scope="row" class="btn-st">
                                        <a href="<?php echo SITEURL; ?>admin/update.password.php?id=<?php echo $id; ?>" class=""><img src="../assets/admin/password.png" alt="Change password" style="width: 35px;" class="mr-3"></a>
                                        <a href="<?php echo SITEURL; ?>admin/update.admin.php?id=<?php echo $id; ?>" class=""><img src="../assets/admin/edit.png" alt="Edit user" style="width: 35px;" class="mr-3"></a>
                                        <a href="<?php echo SITEURL; ?>admin/delete.admin.php?id=<?php echo $id; ?>" class="" data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="../assets/admin/delete.png" alt="Delete user" style="width: 35px;" class="mr-3"></a>
                                    </td>
                                </tr>

                            <?php
                            }
                        }
                    } else {

                    }

                ?>

            </table>

        </div>
        
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    include ('partials/footer.php');
?>