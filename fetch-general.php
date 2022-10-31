<div class="main" style="height:100%; padding-bottom:15em;">
    <div class="container-fluid w-75">
        <div class="row mt-5">
			<?php
			ob_start();
			include('./configs/constants.php');
			require ('functions.php');

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
			<div  class="p-0 m-2 btn card d-flex justify-content-center align-items-center prod_btn bg-green" style="width:15vw; background-color: #98C9A3;" >
				<p href=""><img src="<?php echo SITEURL; ?>images/product/<?php echo $row['image']; ?>" style="padding-top: 20px;" alt="" width="200px" height="200px"></p>
				<div class="text-center"> <?php echo $title; ?> </div>
				<div class="text-center"> <?php echo $price; ?> </div>
				
				<form action="login-page.php" method="POST">
					<?php
						if(in_array(0, $Cart->getCartId($product->getData('bridge')) ?? [])){
							echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
						}else{
							echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
						}
					?>
				</form>
				<div style="padding-top: 20px;">
					
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
