<style type="text/css">
	.img-thumbnail {
		margin:auto!important; height: 200px!important; width: 300px!important;
	}
	.img-thumbnail:hover {
		box-shadow: 0px 0px 10px #333;
	}

</style>
			<div class="row">
				<h3 class="text-center">Top Products</h3>
				<?php
				include_once('Includes/Connection.php');
				$sql = "SELECT ProductName, Image FROM product"; /* ORDER BY product_id DESC */
				$result = mysqli_query($con, $sql);
				if(!$result)
				{
					die('Could not get Data !' . mysqli_error());
				}
				$flag = 1;
				$rowcount = mysqli_num_rows($result);
				for ($i=1; $i<=4; $i++) {
				    //$image = "uploads/p" . $i . ".jpg";
				    echo "<div class='col-md-3 text-center' style='padding: 0px;'>";
				    
				   // echo "<img class='img-thumbnail' style='' src='".$image."'/><br/>";
					while($row1 = mysqli_fetch_array($result))
					{
						echo '<img src="data:image;base64,'.base64_encode($row1['Image']).'" class="img-responsive img-thumbnail" style="height: 150px; width: 200px;"/>';
						echo "<h4 class='text-primary'>".$row1['ProductName']."</h4>";	// <a href='".str_replace(' ', '', $row1[0]).".php'>
						$flag++;
						if($flag!=$i)
							break;
					}
				    echo "</div>";
				}
				?>
			</div>