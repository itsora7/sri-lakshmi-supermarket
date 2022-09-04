			<div class="row" id="category">
				<h3 class="text-center">Top Categories</h3>
				<?php
				include_once('Includes/Connection.php');
				$sql = "SELECT categoryName FROM category ORDER BY categoryID";
				$result = mysqli_query($con, $sql);
				if(!$result)
				{
					die('Could not get Data !' . mysqli_error());
				}
				$flag = 1;
				$rowcount = mysqli_num_rows($result);
				for ($i=$rowcount; $i>$rowcount-4; $i--) {
				    $image = "uploads/" . $i . ".jpg";
				    echo "<div class='col-md-3 text-center' style='padding: 0px;'>";
				    echo "<img class='img-thumbnail' style='height: 200px!important; width: 300px!important;' src='".$image."'/>";
					while($row1 = mysqli_fetch_array($result))
					{
						echo "<h4>".str_replace(' ', '', $row1[0])."</h4>";
						$flag++;
						if($flag!=$i)
							break;
					}
				    echo "</div>";
				}
				?>
			</div>