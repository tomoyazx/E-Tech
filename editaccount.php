<html lang="en">
<head>
	<title>E-TECH - Edit Account</title>
</head>

<body>
<?php
	include "templates/header.php";
	require 'db/db.php';
	// deleteproduct page refer
	// form action
	$email = $_SESSION['email'];
	$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());
	$users = $result->fetch_assoc();
		

	if(isset($_POST['email'])){
		//edit account
		
		$nfirst_name = $mysqli->escape_string($_POST['firstname']);
		$nlast_name = $mysqli->escape_string($_POST['lastname']);
		$nemail = $mysqli->escape_string($_POST['email']);
		$naddress = $mysqli->escape_string($_POST['address']);
		$nmobilenumber = $mysqli->escape_string($_POST['mobilenumber']);
			
		$sql = "UPDATE users SET first_name='$nfirst_name', last_name='$nlast_name', email='$nemail', address='$naddress',mobilenumber='$nmobilenumber' WHERE email='$email'";
		$res = $mysqli->query($sql) or die($mysqli->error());
		
		header("location: myaccount.php");
			
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
						<h1>Edit Account</h1>
					  
						<form action="" method="post" autocomplete="off">
					  
							<div class="top-row">
								<div class="field-wrap">
								<label>
									First Name<span class="req"></span>
								</label>
								<input type="text" required autocomplete="off" name='firstname' class="form-control"
								value="<?php echo $users['first_name']; ?>"/>
								</div>
						
								<div class="field-wrap">
								<label>
									Last Name<span class="req"></span>
								</label>
								<input type="text"required autocomplete="off" name='lastname' class="form-control"
								value="<?php echo $users['last_name']; ?>"/>
								</div>
							</div>

							<div class="field-wrap">
								<label>
									Email Address<span class="req"></span>
								</label>
								<input type="email"required autocomplete="off" name='email' class="form-control"
								value="<?php echo $users['email']; ?>"/>
							</div>
							
							<div class="field-wrap">
								<label>
									Address
								</label>
								<input type="text" autocomplete="off" name='address' class="form-control"
								value="<?php echo $users['address']; ?>"/>
							</div>
							
							<div class="field-wrap">
								<label>
									Mobile Number
								</label>
								<input type="number" autocomplete="off" name='mobilenumber' class="form-control"
								value="<?php echo $users['mobilenumber']; ?>"/>
							</div>
								<br>
								<button type="submit" class="btn btn-success" name="submit" />Change </button>
							
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
