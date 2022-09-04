<?php
	include_once('../Includes/Connection.php');
	$table_name = 'category';
		if(isset($_POST['submit']))
		{
//			$file_name_real = $_FILES['file']['name'];
			$file_type = $_FILES['file']['type'];
			$file_size = $_FILES['file']['size'];
			$file_tmp_loc = $_FILES['file']['tmp_name'];
			
			$category_name = stripcslashes($_POST['catname']);
			$category_name = htmlspecialchars($category_name);
			$category_name = mysqli_real_escape_string($con, $category_name);
			$Description = stripcslashes($_POST['catdescription']);
			$Description = htmlspecialchars($category_name);
			$Description = mysqli_real_escape_string($con, $Description);
			$Image = stripcslashes($_POST['catname']);
			$Image = htmlspecialchars($Image);
			$Image = mysqli_real_escape_string($con, $Image);
			$image = addslashes(file_get_contents($_FILES["file"]["tmp_name"])); // mysqli_real_escape_string($con, 
			
			$content = "test";

			$sql = "INSERT INTO $table_name (categoryName,Description,Image) VALUES ('$category_name','$Description','$image')";

			if($file_type != "image/jpeg" && $file_type != "image/png" && $file_type != "image/jpg" && $file_type != "image/gif" )
			{
				echo "<script> alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); </script>";
				echo "<script> location.href='AddCategory.php'; </script>";
			}
			else
			{
				if(mysqli_query($con, $sql)){				
					$file_name = mysqli_insert_id($con);
					$file_target_dir = "../uploads/" . $file_name .".jpg"; // "." .$ext;
					fopen("../" .str_replace(' ', '', $category_name). ".php", 'w') or die("Could not create the file.");
					$new_cat_file = $category_name.".php"; 
					echo "<script> alert('File " . $category_name . ".php created!'); </script>";
    				if(file_exists($new_cat_file))
    					echo "<script> alert('File exists!'); </script>";

					echo "<script> alert('Category Successfully Inserted.'); </script>";
					if(move_uploaded_file($file_tmp_loc, $file_target_dir))
						echo "<script> alert('Image Successfully Uploaded.'); </script>";
					else
						echo "<script> alert('Image Upload Failed.!'); </script>";
					echo "<script> location.href='AddCategory.php'; </script>";
				}
				else
				{
					echo "<script> alert('Category Not Inserted.'); </script>";
				}


				//echo "<script> location.href='CategoryUploadForm.php'; </script>"; */
			}
		}
?>