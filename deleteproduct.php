<?php
	require 'db/db.php';
	if(isset($_POST['productid'])) {
		$productid = $_POST['productid'];
		$sql = "DELETE FROM products WHERE productid='$productid' ";
		$result = $mysqli->query($sql) or die($mysqli->error());
		header("location: manageproduct.php");
	}

 ?>