<html lang="en">
<head>
	<title>E-TECH - Manage Product</title>
</head>

<?php
	include "templates/header.php";
	require 'db/db.php';
	
?>
<body>
        <div class="container-fluid">
		<br>
				<div class="col-sm-12">
					<h2>E-TECH Product List <object align="right"><a href="addproduct.php" role="button" class="btn btn-primary btn-sm" >
					Add Product<a/></object> </h2> 
				</div>
				
                <div class="col-sm-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<table class="table">
								<thead>
									<tr>
										<th>Image</th>
										<th>Item</th>
										<th>Price</th>
										<th>Quantity</th>
										<th>Category</th>
										<th>Details</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
										<?php  
											$sql = "SELECT * FROM products";  
											$result = $mysqli->query($sql) or die($mysqli->error());  
											while($row = mysqli_fetch_array($result))  
											{  
												 echo '  
													  <tr>  
														   <td>  
																<img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="150" width="200" class="img-responsive" />  
														   </td>
															<td>'.$row['name'].'</td>
															<td>'.$row['price'].'</td>
															<td>'.$row['quantity'].'</td>
															<td>'.$row['category'].'</td>
															<td>'.$row['details'].'</td>
															<td>
																<form action="editproductform.php?productid='.$row['productid'].'" method="post">
																	<input type="hidden" name="productid" value="'.$row['productid'].'"/>
																	<input type="submit" name="submit" class="btn btn-success btn-sm" value="Edit">
																</form>
																<form action="deleteproduct.php?productid='.$row['productid'].'" method="post">
																	<input type="hidden" name="productid" value="'.$row['productid'].'"/>
																	<input type="submit" name="submit" class="btn btn-danger btn-sm" value="Delete">
																</form>
															</td>
													  </tr>  
												 ';  
											}  
											?>  
								</tbody>
							</table>
						</div>
					</div>
				</div>
				

        </div>

<?php
	include "templates/footer.php";
?>

</body>
</html>
