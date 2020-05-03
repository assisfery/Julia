<p align="center">
	<img src="https://res.cloudinary.com/lilaslab/image/upload/v1588374493/logo_hjvwvb.png" height="96">
</p>

# Web Chatbot | Documentation

## Instalation
Make clone or download of the repository.

```
git clone https://github.com/assisfery/Julia.git
```

## Setup Frontend
The file **demo.php** has the fronted implemented
you can use it or create new file.

### Import file
In **bot.html** file add these files.

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
The file **api/demo-chatbot.php** has a little backend sample implemented
you can use it or create a new file.

In your **chatbot.php** file you can put the follow code.

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
- video
- audio

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

// respond with video
$myBot->hears("send me a video", function($bot){

	$bot->answer(new Message("image", "video-url"));

});

// respond with audio
$myBot->hears("audio", function($bot){

	$bot->answer(new Message("image", "audio-url"));

});

?>
```

## Comparison operator
By default the user input will be compare
with contains operator, so if the user input contains
the hears function key/pattern the bot will do some action.

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

## Util

### Answer As
You can copy answer from one pattern(key/input) to another pattern.

In the follow example we gonna answer for input "/(Hi|Hey)/" like
it should be asnswer for "hello" input.

So if the bot received "/(Hi|Hey)/ it will give the same answer
as "hello" input.

```php
$myBot->hears("hello", function($bot){

	$bot->answer(new Message("text", "Hello my friend"));

});

$myBot->hears("/(Hi|Hey)/", function($bot){
	$bot->answerAs("hello");
}, "regex");

```

### Answer Random
You can let the bot answer choosing a random message.

```php
$myBot->hears("bye", function($bot){

	$bot->answerRandom([
		new Message("text", "See you later"),
		new Message("text", "Bye my dear friend")
	]);

});
```

### Regex
You can use regex to verify if the user
input matches and retrieve some variable from that.

The $matches variable will have all value that matches in (.*)
ordered by the find order.

```php
$myBot->hears("/My name is (.*) and i am (.*) years old/", function($bot, $matches){

	$bot->answer(
		new Message("text", "Nice to meet you " . $matches[0] . " so you have " . $matches[1] )
	);

}, "regex");
```

### Emoji
You can send a response with emoji using the Emoji class.

```php
use Julia\Emoji;

// conversation logic

$myBot->hears("hello", function($bot){

	$bot->answer(new Message("text", "Hello my friend " . Emoji::$smile ));

});

$myBot->hears("bye", function($bot){

	$bot->answer(new Message("text", "See you later my friend " . Emoji::mult(Emoji::$smile, 5) ));

});
```