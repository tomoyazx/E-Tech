<html lang="en">
<head>
	<title>E-TECH - Payment</title>
</head>

<body>
<?php
	include "templates/header.php";
	require 'db/db.php';
	
	if(isset($_POST['submitorder'])) {
		$userid = $_POST['userid'];
		$selectcart = "SELECT * FROM carts WHERE userid='$userid' ";
		$resultcart = $mysqli->query($selectcart) or die($mysqli->error());
		while($rowcart = $resultcart->fetch_assoc()){
			
			/* echo '<input type="text" name="userid" value="'.$rowcart['userid'].'"/>';
			echo '<input type="text" name="productid" value="'.$rowcart['productid'].'"/>';
			echo '<input type="text" name="quantity" value="'.$rowcart['quantity'].'"/>'; */
			$userid = $rowcart['userid'];
			$productid = $rowcart['productid'];
			$quantity = $rowcart['quantity'];
							
			$sql = "INSERT INTO orderview (userid, productid, quantity, status) " 
					. "VALUES ('$userid','$productid','$quantity', 'shipping')";
			$result = $mysqli->query($sql) or die($mysqli->error());

			
		}
		
		$fromcart = "DELETE FROM carts WHERE userid='$userid' ";
		$resultdelete = $mysqli->query($fromcart) or die($mysqli->error());
		header("location: paymentcomplete.php");
		
	}


?>

<body>
	<div class="container">

		<div class="row">

			<div class="col-lg-6">
			
					<br>
					<h2>Shipping and Billing Address</h2>
					<p>Name: <?php echo $users['first_name'].' '.$users['last_name']; ?></p>
					<p>Address: <?php echo $users['address']; ?></p>
					<p>Mobile Number: 0<?php echo $users['mobilenumber']; ?></p>
					<hr>
					
				
				<h2>Order Summary</h2>
				
				<?php
					$userid = $users['id'];
					$sqlcarts = "SELECT * FROM carts WHERE userid='$userid'";
					$resultcarts = $mysqli->query($sqlcarts) or die($mysqli->error()); 
					$total = '';
					
					echo '<div class="panel-body">
										<table class="table">
											<thead>
												<tr>																		
													<th>Item</th>
													<th>Quantity</th>
													<th>Price</th>
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
													<td>'.$rowproducts['name'].'</td>
													<td>'.$rowcarts['quantity'].'</td>
													<td>RM'.$itemtotal.'</td>
												</tr>
											</tbody>';
							}		
					}
											
					echo'	</table>
								<hr>
											<div class="row">
												<div class="col-md-12" >
													<p>Total : RM'.$total.'</p>
													<form action="cart.php" method="post">
														<input type="submit" name="submit" class="btn btn-warning " value="Back to Cart">
													</form>
												</div>
											</div>
									</div>';
				
				?>
				
			</div>
			
			<div class="col-lg-6">
			<br>
				
				
				<h2>Payment</h2>
				<h4>Credit or Debit Cart</h4>
				<form action="" method="post" autocomplete="off">
					  
							<div class="top-row">
								<div class="field-wrap">
								<label>
									Card Number<span class="req"></span>
								</label>
								<input type="text" required autocomplete="off" name='carnumber' class="form-control"/>
								</div>
						
								<div class="field-wrap">
								<label>
									Name on Card<span class="req"></span>
								</label>
								<input type="text"required autocomplete="off" name='cardname' class="form-control"/>
								</div>
								
								<div class="field-wrap">
								<label>
									Expire Date<span class="req"></span>
								</label>
								<input type="text"required autocomplete="off" name='expdate' class="form-control" placeholder="mm/yy"/>
								</div>
								
								<div class="field-wrap">
								<label>
									CCV/CVV<span class="req"></span>
								</label>
								<input type="number"required autocomplete="off" name='ccv' class="form-control" />
								</div>
							</div>
							<?php
							$userid = $users['id'];
							$sqlcarts = "SELECT * FROM carts WHERE userid='$userid'";
							$resultcarts = $mysqli->query($sqlcarts) or die($mysqli->error()); 
							$rowcarts = $resultcarts->fetch_assoc();
							
								echo '<input type="hidden" name="userid" value="'.$rowcarts['userid'].'"/>';

							?>
							<br>
							<button type="submit" class="btn btn-success" name="submitorder" />Place Your Order</button>
				</form>
				<hr>
				<h4>Online Banking</h4>
				<p style="color: red">Online banking not available for now.</p>
			</div>
		</div>
	</div>
			


	<?php
		include "templates/footer.php";
	?>
</body>
</html>
