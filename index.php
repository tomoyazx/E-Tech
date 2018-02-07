<html lang="en">
<head>
	<title>E-TECH - Home</title>
<head>

<?php
	include "templates/header.php";
	
	if (isset($_POST['addtocart'])) {
		
		$userid = $mysqli->escape_string($_POST['userid']);
		$productid = $mysqli->escape_string($_POST['productid']);
		$result = $mysqli->query("SELECT * FROM carts WHERE productid='$productid' AND userid='".$users['id']."'") or die($mysqli->error());
		if ($result->num_rows > 0){
			
			echo "<div class=\"alert alert-warning alert-dismissable\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
				  This item has been added to cart.
				</div>";
			
		} else{
		
			$sql = "INSERT INTO carts (userid, productid, quantity) " 
					. "VALUES ('$userid','$productid','1')";
			$result = $mysqli->query($sql) or die($mysqli->error());
			echo "<div class=\"alert alert-success alert-dismissable\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
				  Item successfully add to cart.
				</div>";
		}
		
	}
	
	if (isset($_POST['nologin'])) {
		echo "<div class=\"alert alert-warning alert-dismissable\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
				  You must login first before you add item to cart.
				</div>";
	}
	
	
?>

<body>
	<?php 
		include "searchbar.php";
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

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="images/banner/nvidiagtx980.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="images/banner/blueasuszenbook.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="images/banner/logitechbanner.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
		  
		  <!--- Item Display--->
          <div class="row">
			<?php
				$result = $mysqli->query("SELECT * FROM products ") or die($mysqli->error());
				
				while($row = $result->fetch_assoc()){
					
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
								<div class="card-footer">';
					if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
						echo '
									<form action="index.php" method="post" autocomplete="off">
									  <button type="submit" class="btn btn-warning" name="nologin" id="addtocart"/>Add to Cart </button>
									</form>';
					} else{
						echo '
									<form action="index.php" method="post" autocomplete="off">
										<input type="hidden" name="userid" value="'.$users['id'].'"/> <!-- users id  -->
										<input type="hidden" name="productid" value="'.$row['productid'].'"/>
									  <button type="submit" class="btn btn-warning" name="addtocart" id="addtocart"/>Add to Cart </button>
									</form>';
					}
					echo '</div>
							  </div>
							</div>';
					
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