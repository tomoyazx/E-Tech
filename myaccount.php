<html lang="en">
<head>
	<title>E-TECH - My Account</title>
</head>

<?php
	include "templates/header.php";
	require 'db/db.php';
?>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
			</div>
			
			<div class="col-lg-6">

				<div class="form">
					  
					<div id="login">   
						<br>
						<h1>My Account </h1>
			  
						<form action="" method="post" autocomplete="off">
						  
							<div class="field-wrap">
								<label>
								  Name : <?php echo $users['first_name']." ".$users['last_name']; ?>
								</label>
							</div>
							
							<div class="field-wrap">
								<label>
								  Email : <?php echo $users['email']; ?>
								</label>
							</div>
							
							<div class="field-wrap">
								<label>
								  Address : <?php echo $users['address']; ?>
								</label>
							</div>
							
							<div class="field-wrap">
								<label>
								  Mobile Number : <?php echo $users['mobilenumber']; ?>
								</label>
							</div>
							
							<br>
							
							<div class="field-wrap">
								<label>
								  <a href="editaccount.php">Edit Account</a>
								</label>
							</div>
							
							<div class="field-wrap">
								<label>
								  <a href="changepassword.php" >Change Password</a>
								</label>
							</div>

						 </form>

					</div>  
					
				</div>
			</div>
			
			<div class="col-lg-3">
			</div>
		</div>
	</div>
	<br><br><br><br><br><br><br>
	<?php
		include "templates/footer.php";
	?>
</body>
</html>
