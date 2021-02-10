<?php
include("../../datab.php");
	if(isset($_POST['artistid']))
	{
		$artistid=$_POST['artistid'];
		$query=mysqli_query($db,"SELECT * FROM artists WHERE id=$artistid");
		$row=mysqli_fetch_array($query);
		echo json_encode($row);

	}


?>