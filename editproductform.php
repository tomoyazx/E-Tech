<html lang="en">
<head>
	<title>E-TECH - Update Product</title>
</head>

<body>
<?php
	include "templates/header.php";
	require 'db/db.php';
	
	$productid = $_GET['productid'];
	$result = $mysqli->query("SELECT * FROM products WHERE productid='$productid'") or die($mysqli->error());
	$row = $result->fetch_assoc();

?>

<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
			</div>
			
			<div class="col-lg-6">
				<div class="form">
					  
					<div id="changepassword">   
						<br>
						<h1>Update Product</h1>
					  
						<form action="editproduct.php" method="post" autocomplete="off" enctype="multipart/form-data">
							<input name="productid" type="hidden" id="productid" value="<?php echo $row['productid']; ?>"/>
							<div class="top-row">
								<div class="field-wrap">
									<label>
										Item Image 
									</label>
									<br>
									<input type="file" name="image" >
									
									<div class="field-wrap">
									<label>
										Item Name<span class="req"></span>
									</label>
									<input type="text" required autocomplete="off" name='name' class="form-control"
									value="<?php echo $row['name']; ?>"/>
									</div>
							
									<div class="field-wrap">
									<label>
										Price<span class="req"></span>
									</label>
									<input type="number" required autocomplete="off" name='price' class="form-control"
									value="<?php echo $row['price']; ?>"/>
									</div>
									
									<div class="field-wrap">
									<label>
										Quantity<span class="req"></span>
									</label>
									<input type="number"required autocomplete="off" name='quantity' class="form-control"
									value="<?php echo $row['quantity']; ?>"/>
									</div>
									
									<div class="field-wrap">
									<label>
										Category<span class="req"></span>
									</label>
									<select name="category" class="form-control" >
									  <option value="<?php echo $row['category']; ?>"> <?php echo $row['category']; ?> </option>
									  <option value="PC">PC</option>
									  <option value="Laptop">Laptop</option>
									  <option value="Keyboard">Keyboard</option>
									  <option value="Mouse">Mouse</option>
									  <option value="Others">Ohters</option>
									</select>
									</div>
								
								<div class="field-wrap">
								<label>
									Details
								</label>
								<textarea type="text" name='details' class="form-control" rows="4" cols="50"
								><?php echo $row['details']; ?></textarea>
								</div>
								</div>
								<br>
								<button type="submit" class="btn btn-success" name="submit" id="submit"/>Update </button>
							
						</form>
					</div>
				</div>

			</div>  
					
			</div>
		</div>
			
			<div class="col-lg-3">
			</div>
		</div>
	</div>

	<br><br><br><br>
	<?php
		include "templates/footer.php";
	?>
</body>
</html>


