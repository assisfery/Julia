<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include "head.php";
	?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js" integrity="sha256-jl1+DOsSs9uABTKppOJ2GF8kXoc3XQzBtFFyS0i9Xoo=" crossorigin="anonymous"></script>
</head>
<body>

	<main class="container py-4">
		
		<div class="text-center">
			
			<?php
				include "nav.php";
			?>

			<br>
			<p>
			See how simple you can create a chatbot.
			</p>
			
		</div>

		<br>
		<div id="markdown-box"><?php
			$content = file_get_contents("Readme.md");
			echo htmlentities($content);
		?></div>
		
	</main>
	
	<style>
		
		h1:not(.h1), h2, h3{
			margin-top: 48px;
		}

		h4, h5, h6{
			margin-top: 24px;
		}

	</style>
	<script>
		
		$(document).ready(function(){
			var converter = new showdown.Converter(),
			text = $("#markdown-box").html(),
			html = converter.makeHtml(text);

	    	$("#markdown-box").html(html);
	    });

	</script>

</body>
</html>