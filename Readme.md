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

<style>.bmc-button img{height: 34px !important;width: 35px !important;margin-bottom: 1px !important;box-shadow: none !important;border: none !important;vertical-align: middle !important;}.bmc-button{padding: 7px 10px 7px 10px !important;line-height: 35px !important;height:51px !important;min-width:217px !important;text-decoration: none !important;display:inline-flex !important;color:#ffffff !important;background-color:#BD5FFF !important;border-radius: 5px !important;border: 1px solid transparent !important;padding: 7px 10px 7px 10px !important;font-size: 22px !important;letter-spacing: 0.6px !important;box-shadow: 0px 1px 2px rgba(190, 190, 190, 0.5) !important;-webkit-box-shadow: 0px 1px 2px 2px rgba(190, 190, 190, 0.5) !important;margin: 0 auto !important;font-family:'Cookie', cursive !important;-webkit-box-sizing: border-box !important;box-sizing: border-box !important;-o-transition: 0.3s all linear !important;-webkit-transition: 0.3s all linear !important;-moz-transition: 0.3s all linear !important;-ms-transition: 0.3s all linear !important;transition: 0.3s all linear !important;}.bmc-button:hover, .bmc-button:active, .bmc-button:focus {-webkit-box-shadow: 0px 1px 2px 2px rgba(190, 190, 190, 0.5) !important;text-decoration: none !important;box-shadow: 0px 1px 2px 2px rgba(190, 190, 190, 0.5) !important;opacity: 0.85 !important;color:#ffffff !important;}</style><link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet"><a class="bmc-button" target="_blank" href="https://www.buymeacoffee.com/assisfery"><img src="https://cdn.buymeacoffee.com/buttons/bmc-new-btn-logo.svg" alt="Buy me a coffee"><span style="margin-left:15px;font-size:28px !important;">Buy me a coffee</span></a>

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