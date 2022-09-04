<?php
include_once('Includes/Connection.php');
if(isset($_POST['Register']))
{
	$name = mysqli_real_escape_string($con, $_POST['Username']);
	$mail = mysqli_real_escape_string($con, $_POST['Email']);
	$mob = mysqli_real_escape_string($con, $_POST['Phone']);
	$pas1 = mysqli_real_escape_string($con, $_POST['Password']);
	$pas2 = mysqli_real_escape_string($con, $_POST['Password']);
	if($pas1 == $pas2)
	{
		$pas1 = md5($pas2);
		$query = "INSERT INTO tblUserMaster (username, password, Email, contact) values ('".$name."','".$pas1."','".$mail."','".$mob."');";
		//$result = mysqli_query($con, $query);
		//echo($result);
		if(mysqli_query($con, $query))
		{
			//$fulldate = getdate(date("U"));
	    	//$sql = "INSERT INTO activity(activity, act_date, effected_table) VALUES ('New Registration done into System by ".$name."','$fulldate[mday]/$fulldate[month]/$fulldate[year]','Users');";
	    	//if(mysqli_query($con, $sql)) {			
				echo ("<script> alert('Successfully Registered.'); </script>");
				echo ("<script> location.href = 'Login.php'; </script>");
			//}
			//else {
			//	echo ("<script> alert('Admin will not notify.'); </script>");
			//}
		}
		else
		{
			echo ("<script> alert('Could not register into system.''".mysqli_connect_errno()."''); </script>");
			//header("location: Index.php");
			echo ("<script> location.href = 'login.php'; </script>");
		}
	}
	else
	{
		echo("<script> alert('Password Don't Match.!); </script>");
		echo ("<script> location.href = 'Signup.php'; </script>");
	}
}
else 
{
	echo "Unauthorized Access. Error Code : " . mysqli_connect_errno();
	header("Refresh:1, url=Index.php");
}
?>