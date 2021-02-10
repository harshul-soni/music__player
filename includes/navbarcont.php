<div id="navbarcontainer">
	<nav class="navBar">
		<span onclick="openpage('index.php')" class="logo">
			<img src="assets/images/icons/logo.png">


		</span>

		<div class="group">
			<div class="navitem">
				<span onclick="openpage('search.php')" class="navlink">Search
					<img src="assets/images/icons/search.png" class="iconsearch">
				</span>
				
			</div>
			
		</div>

		<div class="group">
			<div class="navitem">
				<span onclick="openpage('browse.php')" class="navlink">Browse</span>
				
			</div>
			<div class="navitem">
				<span onclick="openpage('yourmusic.php')" class="navlink">Your Music</span>
				
			</div>
			<div class="navitem">
				<span onclick="openpage('settings.php')" class="navlink"><?php echo $userloggedin->getname(); ?></span>
				
			</div>
			
		</div>
		
	</nav>

	
</div>