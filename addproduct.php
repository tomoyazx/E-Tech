<html lang="en">
<head>
	<title>E-TECH - Add A Product</title>
</head>

<body>
<?php
	include "templates/header.php";
	require 'db/db.php';
	
	if (isset($_POST['submit'])) {
		
		$image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
		
		$name = $mysqli->escape_string($_POST['name']);
		$price = $mysqli->escape_string($_POST['price']);
		$quantity = $mysqli->escape_string($_POST['quantity']);
		$category = $_POST['category'];
		$details = $mysqli->escape_string($_POST['details']);
		
		$sql = "INSERT INTO products (image, name, price, quantity,category, details) " 
				. "VALUES ('$image', '$name','$price','$quantity','$category', '$details')";
		$result = $mysqli->query($sql) or die($mysqli->error());
		header("location: manageproduct.php");
		
	}
		

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
						<h1>Add A Product</h1>
					  
						<form action="" method="post" autocomplete="off" enctype="multipart/form-data">
					  
							<div class="top-row">
								<div class="field-wrap">
								<label>
									Item Image <span class="req"></span>
								</label>
								<br>
								<input type="file" name="image" id="image" required>
								<div>
								<label>
									Item Name<span class="req"></span>
								</label>
								<input type="text" required autocomplete="off" name='name' class="form-control"/>
								</div>
						
								<div class="field-wrap">
								<label>
									Price<span class="req"></span>
								</label>
								<input type="number" required autocomplete="off" name='price' class="form-control"/>
								</div>
								
								<div class="field-wrap">
								<label>
									Quantity<span class="req"></span>
								</label>
								<input type="number"required autocomplete="off" name='quantity' class="form-control"/>
								</div>
								
								<div class="field-wrap">
								<label>
									Category<span class="req"></span>
								</label>
								<select name="category" class="form-control">
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
								<textarea type="text" name='details' class="form-control" rows="4" cols="50"></textarea>
								</div>
							</div>
								<br>
								<button type="submit" class="btn btn-success" name="submit" id="submit"/>Add </button>
							
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

<script>  
 $(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg','JPG','JPEG']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>  
