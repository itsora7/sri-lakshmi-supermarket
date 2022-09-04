<?php
    session_start();
    if(isset($_SESSION['user']))
    {
	session_destroy();
	header ( "refresh:1; url=Index.php" );
	}
	else
	{
		echo "Unauthorized Access.!";
		header ( "refresh:1; url=Index.php" );
	}
?>