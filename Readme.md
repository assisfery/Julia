<p align="center">
	<img src="https://res.cloudinary.com/lilaslab/image/upload/v1588374493/logo_hjvwvb.png" height="96">
</p>

<div align="center">
	
	A productive chatbot development engine,
	where we can build chatbots in simple
	way without spend time.

</div>

<p align="center">
	<a href="https://github.com/assisfery/Julia/tree/master/docs">Documentation</a> |
	<a href="https://github.com/assisfery/Julia">GitHub</a>
</p>

<p align="center">
	<img src="https://res.cloudinary.com/lilaslab/image/upload/v1588375100/chat_byrhim.png">
</p>

### Web Chatbot
Start developing your chatbot in easy and practical way.

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

### Donate
<br>

<a href="https://www.buymeacoffee.com/assisfery" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/default-violet.png" alt="Buy Me A Coffee" style="height: 51px !important;width: 217px !important;" ></a>

<br><br>

### Contribute
<div>
	Come contribute with us and let's make the world a better place.
</div>

### Others
<div>
	Icons made by
	<a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
</div>