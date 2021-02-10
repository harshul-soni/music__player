<?php
include("../../datab.php");
if(isset($_POST['songid']))
{
	$songid=$_POST['songid'];
	$query=mysqli_query($db,"UPDATE songs SET songplays=songplays+1 WHERE id=$songid");
}

?>
