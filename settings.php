<?php

include("includes/includedfile.php");

?>

<div class="entityinfo">
	<div class="centersection">
		<div class="userinfo">
			<h1><?php echo $userloggedin->getname(); ?></h1>
			<div class="buttonitem">
				<button class="button" onclick="openpage('updatedetails.php')">USER DETAILS</button>
				<button class="button" onclick="logout()">LOGOUT</button>
				
			</div>
			
		</div>
		
	</div>
	
</div>