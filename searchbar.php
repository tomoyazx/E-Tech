<?php 
require 'db/db.php';



?>

<body>
	<div class="container" style="margin-top: 5%;" >
		<div class="row">
			<div class="col-lg-12">

				<!-- Search Form -->
				<form role="form" action="search.php" method="POST">
					
						
					<div class="form-group">
						<div class="input-group">
							<input class="form-control" type="text" name="search" placeholder="Search" >
							<span class="input-group-btn">
								<button class="btn btn-success" type="submit" name="submit">Search</button>

							</span>
						</div>
					</div>
					
					
				</form>
					
			</div>
		</div>
	</div>
</body>