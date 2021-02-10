<?php
include("includes/includedfile.php");



?>
<div class="userdetails">
	<div class="container borderbottom" >
		<h2>EMAIL</h2>
		<input type="email" class="email" name="email" placeholder="Email." value="<?php echo $userloggedin->getemail();?>">
		<span class="message"></span>
		<button class="button" onclick="updateemail('email')">SAVE</button>
		

	</div>

	<div class="container">
		<h2>PASSWORD</h2>
		<input type="password" name="oldpassword" class="oldpassword" placeholder="Current Password">
		<input type="password" name="newpassword1" class="newpassword1" placeholder="New Password">
		<input type="password" name="newpassword2" class="newpassword2" placeholder="Confirm Password">
		<span class="message"></span>
		<button class="button" onclick="updatepassword('oldpassword','newpassword1','newpassword2')">SAVE</button>
		
	</div>
	
</div>