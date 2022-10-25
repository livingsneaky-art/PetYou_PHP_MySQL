<div class="main" style="height:100%; padding-bottom:15em;">
    <div class="container-fluid w-75">
        <div class="row mt-5">

<?php
    ob_start();
    // include header.php file
    include('./configs/constants.php');
?>  
<!---main section--->

<?php
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM product 
	WHERE title LIKE '%".$search."%'";
}
else
{
	$query = "
	SELECT * FROM product ORDER BY productID";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_array($result))
	{
		$id = $row['productID'];
		$title = $row['title'];
		$description = $row['description'];
		$price = $row['price'];
		$image = $row['image'];
	
?>
 <button type="button" class="p-0 m-2 btn card d-flex justify-content-center align-items-center prod_btn bg-green" style="width:15vw; background-color: #98C9A3;" data-toggle="modal" data-target="#exampleModalCenter<?php echo $id?>">
	<img style="padding-top: 30px; height: 15vw;" src="<?php echo SITEURL; ?>images/product/<?php echo $image; ?>" alt="" width="200px">
	<div class="text-center"> <?php echo $title; ?> </div>
	<div class="text-center prod_price" > ₱<?php echo $price?> </div>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"><?php echo $title; ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php echo $description ?>
			</div>
			<div class="modal-footer">
				<!-- DIRI I BUTANG RYAN TUNG PARA ADD TO CART -->
			</div>
		</div>
	</div>
</div>      
<?php
}

}else{
	echo 'Data Not Found';
}

?>

		</div>            
	</div>
</div>

