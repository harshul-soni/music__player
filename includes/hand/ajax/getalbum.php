<?php
include("../../datab.php");
if(isset($_POST['albumid']))
{
	$albumid=$_POST['albumid'];
	$query=mysqli_query($db,"SELECT * FROM albums WHERE id=$albumid");
	$row=mysqli_fetch_array($query);
	echo json_encode($row);
}


?>