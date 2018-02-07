<?php
/* Log out process, unsets and destroys session variables */
session_start();
session_unset();
session_destroy(); 

//header("location: index.php");

?>

<html lang="en">
<head>
	<title>E-TECH - Logout</title>
</head>
<body>
<?php
	include "templates/header.php";
	require 'db/db.php';
	
?>
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
			</div>
			
			<div class="col-lg-6">
				
				<br>
				<h1>Thank You For Stoping By</h1>
				<p>You have logout from E-TECH. We hope to see you again.</p>
				<p>Click <a href="index.php">here</a> return to home page.</p>
				<br>

			</div>
			
			<div class="col-lg-3">
			</div>
		</div>
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br>
	<?php 
		include "templates/footer.php";
	?>
</body>
</html>
