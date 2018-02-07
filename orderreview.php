<html lang="en">
<head>
	<title>E-TECH - Order Review</title>
<head>

<?php
	include "templates/header.php";
	require 'db/db.php';
	
	
?>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="cart_msg">
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
			<br>
				<h1> My Orders </h1>
				<div class="panel panel-default">
					
				<?php  
				$userid = $users['id'];
				$sql = "SELECT * FROM orderview WHERE userid='$userid'";
				$result = $mysqli->query($sql) or die($mysqli->error()); 
				$total = '';

				if($row = $result->num_rows >0){
					echo '<div class="panel-body">
									<table class="table">
										<thead>
											<tr>																		
												<th>Item</th>
												<th></th>
												<th>Price</th>
												<th>Quantity</th>
												<th>Total price for item</th>
												<th>Status</th>
											</tr>
										</thead>';

					while($row = $result->fetch_assoc()){
						if ($users['id']==$row['userid']){
							$productid = $row['productid'];
							$sqlproducts = "SELECT * FROM products WHERE productid='$productid'"; 
							$resultproducts = $mysqli->query($sqlproducts) or die($mysqli->error());
							$rowproducts = $resultproducts->fetch_assoc();
							
							$itemtotal = $row['quantity']*$rowproducts['price'];
							$total +=$itemtotal;
							echo '
										<tbody>  
											<tr>  
												<td>  
													<img src="data:image/jpeg;base64,'.base64_encode($rowproducts['image'] ).'" height="75" width="100" class="img-responsive" />
												</td>
												<td>'.$rowproducts['name'].'</td>
												<td>RM'.$rowproducts['price'].'</td>
												<td>'.$row['quantity'].'</td>
												<td>RM'.$itemtotal.'</td>
												<td style="color: blue">'.$row['status'].'</td>
											</tr>
										</tbody>';
						}		
					}

					echo'	</table>
							<hr>
										
								</div>';
				} else {
					echo'<h3>You didn\'t have any ordered item.</h3>
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