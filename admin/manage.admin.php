<?php
    ob_start();
    // include header.php file
    include ('partials/header.php');
?>
 <!---main section--->
 <div class="main" style="height:100vh;">
        <div class="container">
            <h2>MANAGE ADMIN</h2>

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

            <a href="add.admin.php" class="button">ADD ADMIN</a>

            <table class="tbl-full" style="height:auto;">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                </tr>

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
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $fName; ?></td>
                                    <td><?php echo $lName; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td class="btn-st">
                                        <a href="<?php echo SITEURL; ?>admin/update.password.php?id=<?php echo $id; ?>" class="btn-blue btn">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update.admin.php?id=<?php echo $id; ?>" class="btn-green btn">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete.admin.php?id=<?php echo $id; ?>" class="btn-red btn">Delete Admin</a>
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
<?php
    include ('partials/footer.php');
?>