<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include "head.php";
	?>
</head>
<body>

	<main class="container py-4 text-center">
		
		<br>
		<h1>
			<img src="assets/img/african-woman.svg" alt="african-woman" height="84">
			Julia | Chatbot Engine
		</h1>

		<?php
			include "nav.php";
		?>

		<div>
			<div class="lds-ripple">
				<div></div>
				<div></div>
			</div>
		</div>
		
		<div class="chat-box">
			<div class="message-box"">
				<div>
					Hello my name is Julia and
					i am a chatbot made
					to simplify your life.
				</div>
			</div>

			<!-- <div class="message-box message-box-2">
				<div>Lorem</div>
			</div> -->

			<!-- <div class="typing-box">
				<div class="lds-ellipsis">
					<div></div>
					<div></div>
					<div></div>
				</div>
			</div> -->
		</div>

		<br>
		<div class="compose-box">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="write a message...">
				<div class="input-group-append">
					<button class="btn btn-primary" type="submit">send</button>
				</div>
			</div>
		</div>
		
	</main>

	<script src="assets/js/julia.js"></script>
	<script>
		// Julia.addChatBox(".chat-box2");
		// Julia.addComposeBox(".compose-box2");
	</script>
	
</body>
</html>