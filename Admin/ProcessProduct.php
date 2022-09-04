<?php
	include_once('../Includes/Connection.php');
	$table_name = 'product';
		if(isset($_POST['submit']))
		{
			$file_name_real = $_FILES['file']['name'];
			$file_type = $_FILES['file']['type'];
			$file_size = $_FILES['file']['size'];
			$file_tmp_loc = $_FILES['file']['tmp_name'];

			$categoryId = mysqli_real_escape_string($con, $_POST['catName']);
			$price = mysqli_real_escape_string($con, $_POST['price']);
			$productname = mysqli_real_escape_string($con, $_POST['pro_name']);
			$brandname = mysqli_real_escape_string($con, $_POST['brnd_name']);
			$qntity = mysqli_real_escape_string($con, $_POST['quntity']);
			$image = addslashes(file_get_contents($_FILES["file"]["tmp_name"])); // mysqli_real_escape_string($con, $_POST['file']);
			$Image = stripcslashes($_POST['file']);
			$Image = htmlspecialchars($Image);
			$Image = mysqli_real_escape_string($con, $Image);

			$sql = "INSERT INTO $table_name (ProductName, BrandName, Quantity, CategoryID, price, Image) VALUES ('$productname', '$brandname', '$qntity', '$categoryId', '$price', '$image');";
			if($file_type != "image/jpeg" && $file_type != "image/png" && $file_type != "image/jpg" && $file_type != "image/gif" )
			{
				echo "<script> alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); </script>";
				echo "<script> location.href='AddProduct.php'; </script>";
			}
			else
			{
				if(mysqli_query($con, $sql)) {	
					 $file_name = mysqli_insert_id($con);
					 $file_name = "p".$file_name;
					 $ext = pathinfo($file_name_real, PATHINFO_EXTENSION);
					 $file_target_dir = "../uploads/" . $file_name ."." . $ext;
					 echo "<script> alert('Product Successfully Inserted.'); </script>";
					 if(move_uploaded_file($file_tmp_loc, $file_target_dir))
						echo "<script> alert('Image Successfully Uploaded.'); </script>";
					 else
					 	echo "<script> alert('Image Upload Failed.!'); </script>";
					 echo "<script> location.href='AddProduct.php'; </script>";
				}
				else
				{  
					// echo ("<script> alert('Could not register into system.''".mysqli_connect_errno()."''); </script>");
					echo "<script> alert('Product Not Inserted.''".mysqli_connect_errno()."''); </script>";
				} 
				echo "<script> location.href='AddProduct.php'; </script>";
			}	
		}
?>