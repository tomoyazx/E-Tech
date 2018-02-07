<?php 
require 'db/db.php';

	$result = $mysqli->query("SELECT * FROM products WHERE productid='26'") or die($mysqli->error());
	
	
	
?>
<select name="category" class="form-control" >
<?php 
while($row = $result->fetch_assoc()){
	echo '<option value="'.$row['category'].'" > '.$row['category'].' </option>';
}	
?>							  
</select>