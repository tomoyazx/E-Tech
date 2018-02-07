<html lang="en">
<head>
	<title>E-TECH - Cart</title>
<head>

<?php
	include "templates/header.php";
	require 'db/db.php';
	
	if(isset($_POST['remove'])) {
		$id = $_POST['id'];
		$sql = "DELETE FROM carts WHERE id='$id' ";
		$result = $mysqli->query($sql) or die($mysqli->error());
		echo "<div class=\"alert alert-success alert-dismissable\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">x</a>
				  Item successfully remove from cart.
				</div>";
		
	}
	
	if(isset($_POST['updatequantity'])) {
		$id = $_POST['id'];
		$quantity = $_POST['quantity'];	
		$sql = "UPDATE carts SET quantity='$quantity' WHERE id='$id'";
		$result = $mysqli->query($sql) or die($mysqli->error());
		
	} 
	
?>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="cart_msg">
				<!--Cart Message--> 
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
			<br>
				<h1> My Cart </h1>
				<div class="panel panel-default">
					
				<?php  
				$userid = $users['id'];
				$sqlcarts = "SELECT * FROM carts WHERE userid='$userid'";
				$resultcarts = $mysqli->query($sqlcarts) or die($mysqli->error()); 
				$total = '';

				if($rowcarts = $resultcarts->num_rows >0){
					echo '<div class="panel-body">
									<table class="table">
										<thead>
											<tr>																		
												<th>Item</th>
												<th></th>
												<th>Price</th>
												<th>Quantity</th>
												<th>Total price for item</th>
												<th></th>
											</tr>
										</thead>';

					while($rowcarts = $resultcarts->fetch_assoc()){
						if ($users['id']==$rowcarts['userid']){
							$productid = $rowcarts['productid'];
							$sqlproducts = "SELECT * FROM products WHERE productid='$productid'"; 
							$resultproducts = $mysqli->query($sqlproducts) or die($mysqli->error());
							$rowproducts = $resultproducts->fetch_assoc();
							
							$itemtotal = $rowcarts['quantity']*$rowproducts['price'];
							$total +=$itemtotal;
							echo '
										<tbody>  
											<tr>  
												<td>  
													<img src="data:image/jpeg;base64,'.base64_encode($rowproducts['image'] ).'" height="75" width="100" class="img-responsive" />
												</td>
												<td>'.$rowproducts['name'].'</td>
												<td>RM'.$rowproducts['price'].'</td>
												<td>
													<form action="cart.php" method="post" autocomplete="off">
													<div class="input-group">
														<input type="hidden" name="id" value="'.$rowcarts['id'].'"/>
														<input type="number" name="quantity" class="form-control" value="'.$rowcarts['quantity'].'" style="width: 80px">
														<div class="input-group-btn">
														<button class="btn btn-primary btn-sm" type="submit"name="updatequantity">Update
														</button>
														</div>
													</div>
													</form>
												</td>
												<td>RM'.$itemtotal.'</td>
												<td>
													<center>
														<form action="" method="post" >
															<input type="hidden" name="id" value="'.$rowcarts['id'].'"/>
															<input type="submit" name="remove" class="btn btn-danger btn-sm" value="Remove">
														</form>
													</center>
												</td>
											</tr>
										</tbody>';
						}		
					}

					echo'	</table>
							<hr>
										<div class="row">
											<div class="col-md-8"></div>
											<div class="col-md-4" >
												<object align="right">
													<center>
														<p>Total : RM'.$total.'</p>
														<form action="payment.php" method="post">
															<input type="submit" name="submit" class="btn btn-success " value="Checkout">
														</form>
													<center>
												</object>
											</div>
										</div>
								</div>';
				} else {
					echo'<h3>There is no item in the cart.</h3>
					<p>Click <a href="index.php">here</a> to home page.</p>';
					
				}

?>
					<br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
			</div>
			<div class="col-md-2"></div>
					
		</div>
		
	</div>
	<?php
	include "templates/footer.php";
?>
</body>
</html>