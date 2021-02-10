<?php

include("../../datab.php");
if(!isset($_POST['username'])){
	echo "Username not set";
	exit();
}
if(!isset($_POST['oldpassword']) || !isset($_POST['newpassword1']) || !isset($_POST['newpassword2'])){
	echo "Not All passwords are set";
	exit();
}
if($_POST['oldpassword']=="" || $_POST['newpassword1']=="" || $_POST['newpassword2']==""){
	echo "Please fill in all fields";
	exit();
}

$username=$_POST['username'];
$oldpassword=$_POST['oldpassword'];
$newpassword1=$_POST['newpassword1'];
$newpassword2=$_POST['newpassword2'];

$oldpassmd5=md5($oldpassword);
$passcheck=mysqli_query($db,"SELECT * FROM users WHERE username='$username' AND password='$oldpassmd5'");
if(mysqli_num_rows($passcheck)!=1){
	echo "Password incorrect";
	exit();
}
if($newpassword1!=$newpassword2){
	echo "Password mismatch";
	exit();
}
if(preg_match('/[^A-Za-z0-9]/',$newpassword1)){
	echo "Password should only contain numbers and Letters..";
	exit();
}
if(strlen($newpassword1)>30 || strlen($newpassword1)<5){
	echo "Password should be between 5 to 30";
	exi();
}

$newmd5pass=md5($newpassword1);

$query=mysqli_query($db,"UPDATE users SET password = '$newmd5pass' WHERE username='$username'");
echo "Password changed successfully";


?>