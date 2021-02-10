<?php include("includes/includedfile.php"); ?>

<h1 class="bigheading">Music you might like</h1>

<div class="gridviewcontainer">
	<?php

	$albumquery=mysqli_query($db,"SELECT * FROM albums ORDER BY RAND() LIMIT 10");
	while($row=mysqli_fetch_array($albumquery))
	{
		echo "<div class='griditem'>
		<span onclick='openpage(\"album.php?id=" . $row["id"] . "\")'>
		<img src=".$row['images'].">
			<div class='gridinfo'>
				".$row['name']."

			</div>
		</span>


		</div>";
	}


	?>
</div>
