<?php
include_once('Includes/Connection.php');
if(isset($_POST['Search']))
{
	$search = mysqli_real_escape_string($con, $_POST['Product']);
	echo ($mob);
	if(!is_null($search))
	{
		$query = "SELECT * FROM product where productname='.$search.";
		//$result = mysqli_query($con, $query);
		//echo($result);
		if(mysqli_query($con, $query))
		{
				echo ("<script> location.href = 'products.php'; </script>");
			
		}
		else
		{
			echo ("<script> alert('Could not find the searched item.'); </script>");
			//header("location: Index.php");
			echo ("<script> location.href = 'products.php'; </script>");
		}
	}
	else
	{
		echo("<script> alert('Please Insert Search Item.!); </script>");
		echo ("<script> location.href = 'products.php'; </script>");
	}
}
else 
{
	header("Refresh:1, url=products.php");
}
?>