<html lang="en">
<head>
	<title>E-TECH - Sign Up</title>
</head>

<body>
<?php
	include "templates/header.php";
	require 'db/db.php';
	
	if (isset($_POST['email'])) { 
        
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['first_name'] = $_POST['firstname'];
		$_SESSION['last_name'] = $_POST['lastname'];


		// Escape all $_POST variables to protect against SQL injections
		$first_name = $mysqli->escape_string($_POST['firstname']);
		$last_name = $mysqli->escape_string($_POST['lastname']);
		$email = $mysqli->escape_string($_POST['email']);
		$address = $mysqli->escape_string($_POST['address']);
		$mobilenumber = $mysqli->escape_string($_POST['mobilenumber']);
		$password = $mysqli->escape_string($_POST['password']);
		$password2 = $mysqli->escape_string($_POST['password2']);
		$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
			
		// Check if user with that email already exists
		$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());

		// We know user email exists if the rows returned are more than 0
		if ( $result->num_rows > 0 ) {
			
			echo "<div class=\"alert alert-warning alert-dismissable\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
				  This E-mail was used by someone.
				</div>";
		
		// Check if the passwords are not in these condition		
		}else if(strlen($password) < 8 ){
			
			echo "<div class=\"alert alert-warning alert-dismissable\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
					  Your password must be minimum 8 characters.
					</div>";

		}else if(strlen($password) > 16 ){
			
			echo "<div class=\"alert alert-warning alert-dismissable\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
					  Your password must be maximum 16 characters.
					</div>";

		}else if(!preg_match("#[0-9]+#", $password)){

			echo "<div class=\"alert alert-warning alert-dismissable\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
					  Your password must include a number.
					</div>";

		}else if(!preg_match("#[a-z]+#", $password)){

			echo "<div class=\"alert alert-warning alert-dismissable\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
					  Yor password must include lowercase letter.
					</div>";
		}
		else if(!preg_match("#[A-Z]+#", $password)){

			echo "<div class=\"alert alert-warning alert-dismissable\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
					  Yor password must include uppercase letter.
					</div>";

		} elseif ($password != $password2){ // Check if the passwords are not match	
			
				echo "<div class=\"alert alert-warning alert-dismissable\">
						<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
					  Your password were not match.
					</div>";
				
		} else {
			$addadmin = strchr($email,"@etech.com");
			if($addadmin == ''){

				$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

				$sql = "INSERT INTO users (first_name, last_name, email, password, hash, address, mobilenumber) " 
						. "VALUES ('$first_name','$last_name','$email','$password', '$hash', '$address', '$mobilenumber')";
						
				$result = $mysqli->query($sql) or die($mysqli->error()); 

				header("location: index.php");
			}else{

				$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

				$sql = "INSERT INTO users (first_name, last_name, email, password, hash, address, mobilenumber, admin) " 
						. "VALUES ('$first_name','$last_name','$email','$password', '$hash', '$address', '$mobilenumber', '1')";
						
				$result = $mysqli->query($sql) or die($mysqli->error());

				header("location: index.php");
			}

		}
	}	

?>

<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
			</div>
			
			<div class="col-lg-6">
				<div class="form">
					  
					<div id="signup">   
						<br>
						<h1>Sign Up</h1>
					  
						<form action="" method="post" autocomplete="off">
					  
							<div class="top-row">
								<div class="field-wrap">
								<label>
									First Name<span class="req"></span>
								</label>
								<input type="text" required autocomplete="off" name='firstname' class="form-control"/>
								</div>
						
								<div class="field-wrap">
								<label>
									Last Name<span class="req"></span>
								</label>
								<input type="text"required autocomplete="off" name='lastname' class="form-control"/>
								</div>
							</div>

							<div class="field-wrap">
								<label>
									Email Address<span class="req"></span>
								</label>
								<input type="email"required autocomplete="off" name='email' class="form-control"/>
							</div>
						  
							<div class="field-wrap">
								<label>
									Password<span class="req"></span>
								</label>
								<input type="password"required autocomplete="off" name='password' class="form-control"/>
							</div>
							<p style="font-size: 14; color: red">*Password must have minimum 8 characters and maximum 16 characters.</p>
							<p style="margin-top:-20px; font-size: 14; color: red">*Password must include uppercase letter, lowercase letter and numbers.</p>
							<div class="field-wrap">
								<label>
									Confirm Password<span class="req"></span>
								</label>
								<input type="password"required autocomplete="off" name='password2' class="form-control"/>
							</div>
							
							<div class="field-wrap">
								<label>
									Address<span class="req"></span>
								</label>
								<input type="text" autocomplete="off" name='address' class="form-control"/>
							</div>
							
							<div class="field-wrap">
								<label>
									Mobile Number
								</label>
								<input type="number" autocomplete="off" name='mobilenumber' class="form-control"/>
							</div>
							<br>
							<button type="submit" class="btn btn-success" name="submit" />Sign Up</button>
						  
						</form>

					</div>  
					
				</div>
			</div>
			
			<div class="col-lg-3">
			</div>
		</div>
	</div>
	<br>
	<?php
		include "templates/footer.php";
	?>
</body>
</html>
