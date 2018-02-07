<?php 
require 'db/db.php';

		//edit account
		$productid = $_POST['productid'];
		//$image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
		$image = $mysqli->escape_string(file_get_contents($_FILES['image']['tmp_name']));
		$name = $mysqli->escape_string($_POST['name']);
		$price = $mysqli->escape_string($_POST['price']);
		$quantity = $mysqli->escape_string($_POST['quantity']);
		$category = $_POST['category'];
		$details = $mysqli->escape_string($_POST['details']);
		
		if ($image == ""){
			$sql = "UPDATE products SET name='$name', price='$price', quantity='$quantity', category='$category', details='$details' 
				WHERE productid='$productid'";
			$results = $mysqli->query($sql) or die($mysqli->error());
			header("location: manageproduct.php");
		} else{
			$sql = "UPDATE products SET image='$image', name='$name', price='$price', quantity='$quantity', category='$category', details='$details' 
				WHERE productid='$productid'";
			$results = $mysqli->query($sql) or die($mysqli->error());
			header("location: manageproduct.php");
		}
			
		
?>