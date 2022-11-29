<?php
   ob_start();
    // include header.php file
    include ('partials/header.php');
?>
<div class="main" style="height:64vh;">
<div class="container admin">
    <h1>ADMIN PAGE</h1>

    <ul style="list-style:none; display:flex; gap: 1em">
        <li><a href="<?php echo SITEURL; ?>admin/manage.admin.php" class="button">MANAGE ADMIN</a></li>
        <li><a href="<?php echo SITEURL; ?>admin/manage.carts.php" class="button">MANAGE CARTS</a></li>
        <li><a href="<?php echo SITEURL; ?>admin/manage.products.php" class="button">MANAGE PRODUCTS</a></li>
        <li><a href="<?php echo SITEURL; ?>admin/manage.adoption.php" class="button">MANAGE ADOPTION</a></li>
        <li><a href="<?php echo SITEURL; ?>admin/manage.delivery.php" class="button">MANAGE DELIVERY</a></li>
    </ul>
</div>
</div>

<?php
    include ('partials/footer.php');
?>