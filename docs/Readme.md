<p align="center">
	<img src="https://res.cloudinary.com/lilaslab/image/upload/v1588374493/logo_hjvwvb.png" height="96">
</p>

# Web Chatbot | Documentation

## Setup Frontend

### Import file
In **bot.html** file add these files

```html
<link rel="stylesheet" href="assets/css/julia.css">
```
```html
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
```
```html
<script src="assets/js/julia.js"></script>
```

### Change the Bot API Url
You can change if is need the **apiUrl** doing that

```html
<script>
	Julia.apiUrl = "api/demo-chatbot.php";
</script>
```

### Add elements to your html

##### Add chat-box element to your html

```html
<div class="chat-box"></div>
```

##### Or add chat-box using JS

```html
<div class="chat-container"></div>
```

```html
<script>
	Julia.addChatBox(".chat-container");
</script>
```

##### Add compose-box element to your html
```html
<div class="compose-box">
	<div class="input-group mb-3">
		<input type="text" class="form-control" placeholder="write a message...">
		<div class="input-group-append">
			<button class="btn btn-primary" type="submit">send</button>
		</div>
	</div>
</div>
```

##### Or add compose-box using JS
```html
<div class="compose-container"></div>
```

```html
<script>
	Julia.addComposeBox(".compose-container");
</script>
```

## Setup Backend
In the **demo-chatbot.php** file you can put the follow code.

```php
<?php

	include "../lib/WebBot.php";

	use Julia\WebBot;
	use Julia\Message;

	// create the bot
	$myBot = new WebBot();

	// handle the received message
	$myBot->listen();

	// when the bot get a message that contains "hello"
	// it will respond "Hello my friend"
	$myBot->hears("hello", function($bot){

		$bot->answer(new Message("text", "Hello my friend"));

	});

	// send all responses
	$myBot->respond();

?>
```

## Messages Type
The supported messages types are:
- text
- image

```php
<?php

// respond with text
$myBot->hears("hello", function($bot){

	$bot->answer(new Message("text", "text-message" ));

});

// respond with image
$myBot->hears("image", function($bot){

	$bot->answer(new Message("image", "image-url"));

});

?>
```

## Comparison operator
By default the user input will be compare
with contains operator, so if the user input contains
the hears key the bot will do some action

The supported operator are:
- contains (by default)
- equality - the input is the same as the key
- regex - the input matches with the key

```php
<?php

// verify the input with regex
$myBot->hears("/(h|H)ello|(h|H)i/", function($bot){

	$bot->answer(new Message("text", "Yes we understand" ));

}, "regex");

// verify the input with regex
$myBot->hears("NO", function($bot){

	$bot->answer(new Message("text", "Ok will received NO" ));

}, "equality");

?>
```