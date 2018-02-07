<html lang="en">
<head>
	<title>E-TECH - Payment Complete</title>
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
				<h1>Thank You For Purchasing</h1>
				<p>Your order will shipping to you soon.</p>
				<p>Click <a href="orderreview.php">here</a> to review your order.</p>
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
