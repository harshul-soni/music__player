<?php 
	include("../../datab.php");
	if(isset($_POST['songid']))
	{
		$songid=$_POST['songid'];
		$query=mysqli_query($db,"SELECT * FROM songs WHERE id=$songid");
		$row=mysqli_fetch_array($query);
		echo json_encode($row);
	}


?>
