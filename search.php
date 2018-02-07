<html lang="en">
<head>
	<title>E-TECH - Search</title>
<head>

<?php
	include "templates/header.php";
	
	
	
?>

<body>
	<?php 
		include "searchbar.php";
		if(isset($_POST['submit'])){
			$search = $mysqli->escape_string($_POST['search']);
			$result = $mysqli->query("SELECT * FROM products WHERE name LIKE '%$search%' OR category LIKE '%$search%' OR details LIKE '%$search%'") or die($mysqli->error());
			$item = $result->num_rows;
		}
		
		if(isset($_POST['category'])){
			$search = $mysqli->escape_string($_POST['search']);
			$result = $mysqli->query("SELECT * FROM products WHERE category LIKE '%$search%'") or die($mysqli->error());
			$item = $result->num_rows;
		}
	?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <h3 class="my-4">Category:</h3>
          <div class="list-group">
			<?php include 'category.php'; ?>
          </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">
		  <div class="row my-3">
			<div class="col-lg-9">
			<?php echo '<h5>Your search result for "'.$search.'"</h5>
			<h6>Total '.$item.' item found</h6>'; ?>
			</div>
		  </div>

		  <!--- Item Display--->
          <div class="row">
			<?php
					if( $row = $result->num_rows > 0 ){
						
						while ($row = $result->fetch_assoc()){
							echo '<div class="col-lg-4 col-md-6 mb-4">
							  <div class="card h-100">
								<a href="#"><img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'"  height="200" alt=""></a>
								<div class="card-body">
								  <h4 class="card-title">
									<a href="#">'.$row['name'].'</a>
								  </h4>
								  <br>
								  <h5>RM '.$row['price'].'</h5>
								  <p class="card-text">'.$row['details'].'</p>
								</div>
								<div class="card-footer">
								  <button type="submit" class="btn btn-warning" name="submit" id="submit"/>Add to Cart </button>
								</div>
							  </div>
							</div>';
							
						}
						
				} else {
					echo "There are no results matching your search.";
				}

			?>
            

          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

<?php
	include "templates/footer.php";
?>
</body>
</html>