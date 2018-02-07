<html lang="en">
<head>
	<title>E-TECH - Login</title>
</head>

<?php
	include "templates/header.php";
	require 'db/db.php';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['email'])) { 

			$email = $mysqli->escape_string($_POST['email']);
			$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
			
			// User doesn't exist	
			if ( $result->num_rows == 0 ){
				echo "<div class=\"alert alert-warning alert-dismissable\">
				<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
				  This E-mail does not exist. 
				</div>";
			}
			else { // User exists
				$user = $result->fetch_assoc();

				if ( password_verify($_POST['password'], $user['password']) ) {
					
					$_SESSION['email'] = $user['email'];
					$_SESSION['first_name'] = $user['first_name'];
					$_SESSION['last_name'] = $user['last_name'];
					//$_SESSION['active'] = $user['active'];
					
					// This is how we'll know the user is logged in
					$_SESSION['logged_in'] = true;

					header("location: index.php");
					
				}
				else {
					echo "<div class=\"alert alert-warning alert-dismissable\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
				  Your password was incorrect.
				</div>";
				}
			
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
					  
					<div id="login">   
						<br>
						<h1>Login</h1>
			  
						<form action="" method="post" autocomplete="off">
						  
							<div class="field-wrap">
								<label>
								  Email<span class="req"></span>
								</label>
								<input type="email" required autocomplete="off" name="email" class="form-control"/>
							</div>
						  
							<div class="field-wrap">
								<label>
								  Password<span class="req"></span>
								</label>
								<input type="password" required autocomplete="off" name="password" class="form-control"/>
							</div>
						  
							<!--<p class="forgot"><a href="forgot.php">Forgot Password?</a></p>-->
							<br>
						  
							<button class="btn btn-success" name="login" />Log In</button>
						  
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
