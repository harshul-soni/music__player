<?php 
include("includes/Datab.php");

include("includes/classes/Constants.php");
include("includes/classes/Account.php");
$account=new Account($db);

include("includes/hand/register-hand.php");
include("includes/hand/login-hand.php");
function save($name)
{
	if(isset($_POST[$name]))
	{
		echo $_POST[$name];
	}

}



?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
 	crossorigin="anonymous"></script>
 	<script src="assets/js/register.js"></script>
</head>
<body>
	<?php
	if(isset($_POST["registerbtn"]))
	{
		echo '<script>
		$(document).ready(function(){
			$("#hides").show();
			$("#hidl").hide();

		})
		
		</script>';
	}
	else
	{
		echo '<script>
		$(document).ready(function(){
			$("#hides").hide();
			$("#hidl").show();

		})
		
		</script>';
	}


	?>

	<div id="background">
		<div id="logininput">
			<div id="iform">
			<div id="hidl">		
				
				<h1>Login to your Account</h1>					
					<form action="register.php" method="post">
						<p>
							<label for="loginusername">Username</label>
							<input id="loginusername" type="text" name="loginusername" required value="<?php save('loginusername');?>" >
						</p>
						<p>

							<label for="loginpassword">Password</label>
							<input type="password" id="loginpassword" name="loginpassword" required>
						</p>

						<button class="button" type="submit" style="vertical-align:middle" name="loginbtn"><span>LOGIN</span></button>
						<?php echo $account->geterror(Constants::$loginfailed); ?>

						<div class="hasaccount">
							<span id="hidelogin">
								Don't Have an Account ? Sign Up Here!
							
							

							</span>
							
						</div>
					</form>
			</div> <!--hidl-->


				
			

			<div id="hides">			
				<form action="register.php" method="post">
					<h1>Create Your Account</h1>
					<p>
						<label for="uname" >Username :</label>
						<input type="text" id="uname" name="uname" required value="<?php save('uname');?>">
						<?php echo $account->geterror(Constants::$unameerror);
								echo $account->geterror(Constants::$unamealready);
						  ?>

					</p>
					<p>
						<label for="fname">First name</label>
						<input type="text" id="fname" name="fname" required value="<?php save('fname');?>">
						<?php echo $account->geterror(Constants::$fnameerror);  ?>
					</p>
					<p>
						<label for="lname">Last name</label>
						<input type="text" id="lname" name="lname" required value="<?php save('lname');?>">
						<?php echo $account->geterror(Constants::$lnameerror); ?>
					</p>
					<p>
						<label for="email">Email</label>
						<input type="email" id="email" name="email" required value="<?php save('email');?>">
						<?php echo $account->geterror(Constants::$emailerror);
								echo $account->geterror(Constants::$emailtaken);


							 ?>
					</p>
					<p>
						<label for="pass1">Password</label>
						<input type="password" id="pass1" name="pass1" required>
						<?php echo $account->geterror(Constants::$passmis);
							  echo $account->geterror(Constants::$passlengtherror);
							  echo $account->geterror(Constants::$passalpha);
						?>
					</p>
					<p>
						<label for="pass2">Confirm Password</label>
						<input type="password" id="pass2" name="pass2" required>
					</p>
					<p>
						<button class="button" type="submit" style="vertical-align:middle" name="registerbtn"><span>SIGN UP</span></button>
					</p>

					<div class="hasaccount">
						<span id="hidesignup">
							Already have an Account?Login Here!

						</span>
						
					</div>
				</form>
			</div><!--hides-->

			
				
			</div><!--iform-->
			<div id="logintext">
				<h1 style="color:#060606;font-size:45px;margin:25px auto;padding:25px;">Hear the world's sounds</h1>
				
					<p style="color:#060606;font-size:25px;text-align: center;">Create your own playlist</p>
					<p style="color:#060606;font-size:25px;text-align: center;">Free to sign up</p>
				
				
			</div>
			

		</div><!--logininput -->


		
	</div> <!--background -->
	

</body>
</html>
