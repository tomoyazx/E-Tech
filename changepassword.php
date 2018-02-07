<html lang="en">
<head>
	<title>E-TECH - Change Password</title>
</head>

<body>
<?php
	include "templates/header.php";
	require 'db/db.php';
	
	$user=$_SESSION['email'];
	
	if ($user){
		//user logged in
		
		if(isset($_POST['submit'])){
			//changing password
			
			$password = $_POST['password'];
			$npassword = $_POST['npassword'];
			$npassword2 = $_POST['npassword2'];
			
			$result = $mysqli->query("SELECT password FROM users WHERE email='$email'") or die($mysqli->error()); 
			$user = $result->fetch_assoc();
			
			//verify old password
			if ( password_verify($_POST['password'], $user['password']) ) {
				
				// Check if the passwords are not in these condition
				if(strlen($npassword) < 8 ){
			
					echo "<div class=\"alert alert-warning alert-dismissable\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
							  Your password must be minimum 8 characters.
							</div>";

				}else if(strlen($npassword) > 16 ){
					
					echo "<div class=\"alert alert-warning alert-dismissable\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
							  Your password must be maximum 16 characters.
							</div>";

				}else if(!preg_match("#[0-9]+#", $npassword)){

					echo "<div class=\"alert alert-warning alert-dismissable\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
							  Your password must include a number.
							</div>";

				}else if(!preg_match("#[a-z]+#", $npassword)){

					echo "<div class=\"alert alert-warning alert-dismissable\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
							  Yor password must include lowercase letter.
							</div>";
				}
				else if(!preg_match("#[A-Z]+#", $npassword)){

					echo "<div class=\"alert alert-warning alert-dismissable\">
								<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
							  Yor password must include uppercase letter.
							</div>";

				}elseif ($npassword != $npassword2){ // Check if the passwords are not match
					echo "<div class=\"alert alert-warning alert-dismissable\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">x</a>
				  Your new password were not match.
				</div>";
				} else {
					
					$npassword = password_hash($_POST['npassword'], PASSWORD_BCRYPT);
					

					//update password in database
					$sql = "UPDATE users SET password='$npassword' WHERE email='$email'";
					$result = $mysqli->query($sql) or die($mysqli->error());

					header("location: changepasswordsuccess.php");
				}
				
			}else{
				echo "<div class=\"alert alert-warning alert-dismissable\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">x</a>
				  Your old password was incorrect.
				</div>";
				
			}
			
		}
		
		
	}else {
		die("not login");
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
						<h1>Change Password</h1>
					  
						<form action="#" method="post" autocomplete="off">
					  
							<div class="top-row">
							
								<div class="field-wrap">
									<label>
										Old Password<span class="req"></span>
									</label>
									<input type="password"required autocomplete="off" name='password' class="form-control"/>
								</div>

								<div class="field-wrap">
									<label>
										New Password<span class="req"></span>
									</label>
									<input type="password"required autocomplete="off" name='npassword' class="form-control"/>
								</div>
								<p style="font-size: 14; color: red">*Password must have minimum 8 characters and maximum 16 characters.</p>
								<p style="margin-top:-20px; font-size: 14; color: red">*Password must include uppercase letter, lowercase letter and numbers.</p>
								
								<div class="field-wrap">
									<label>
										Confirm New Password<span class="req"></span>
									</label>
									<input type="password"required autocomplete="off" name='npassword2' class="form-control"/>
								</div>
								<br>
								<button type="submit" class="btn btn-success" name="submit" />Change </button>
							</div>
						</form>

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
