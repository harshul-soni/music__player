<?php

	ob_start();
	session_start();

	$time=date_default_timezone_set("Asia/Kolkata");
	$db=mysqli_connect("localhost","root","","spot");
	if(!$db)
	{
		echo "Error connecting to database";
	}



?>
