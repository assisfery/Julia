# Web Chatbot

## Get Started

### Import file
In **bot.html** file add these files

<link rel="stylesheet" href="assets/css/julia.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="assets/js/julia.js"></script>

### Change the Bot API Url
You can change if is need the **apiUrl** doing that

<script>

	Julia.apiUrl = "api/demo-chatbot.php";

</script>

### Add elements to your html

##### Add chat-box element to your html

<div class="chat-box">
</div>

##### Add compose-box element to your html

<div class="compose-box">

<div class="input-group mb-3">

<input type="text" class="form-control" placeholder="write a message...">

<div class="input-group-append">

<button class="btn btn-primary" type="submit">send</button>

</div>

</div>

</div>

