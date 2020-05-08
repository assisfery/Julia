var Julia = {};
Julia.apiUrl = "api/demo-chatbot";
Julia.responseDelay = 1000;

Julia.hears = function(msg)
{
	Julia.showTyping();

	$.ajax({
		type: "POST",
		url: Julia.apiUrl,
		data: JSON.stringify({ type: "text", content: msg }),
	})
	.done(function(data) {

		console.log(data.messages);

		// DELAY 1 S
		setTimeout(function(){

			Julia.says(data.messages);

			$(".typing-box").remove();

		}, Julia.responseDelay);

	})
	.fail(function() {

		alert("error");

		$(".typing-box").remove();

	});
}

Julia.says = function(msgs)
{
	for(var i = 0; i < msgs.length; i++)
	{
		if(msgs[i].type == "image")
		{
			$(".chat-box").append('<div class="message-box"><div><img src="' + msgs[i].content + '"></div></div>');
		}
		else if(msgs[i].type == "video")
		{
			$(".chat-box").append('<div class="message-box"><div><video controls><source src="' + msgs[i].content + '"></video></div></div>');
		}
		else if(msgs[i].type == "audio")
		{
			$(".chat-box").append('<div class="message-box"><div><audio controls><source src="' + msgs[i].content + '"></audio></div></div>');
		}
		else // type = "text"
			$(".chat-box").append('<div class="message-box"><div>' + msgs[i].content + '</div></div>');
	}

	$('.chat-box').animate({scrollTop: $('.chat-box')[0].scrollHeight }, 1000);
}

Julia.getMessage = function()
{
	var msg = $(".compose-box input").val();

	if(msg)
	{
		$(".compose-box input").val("");
		$(".chat-box").append('<div class="message-box message-box-2"><div>' + msg + '</div></div>');

		Julia.hears(msg)
	}

	$('.chat-box').animate({scrollTop: $('.chat-box')[0].scrollHeight}, 100);
}

Julia.addChatBox = function(element)
{
	$(element).html('<div class="chat-box"></div>');
}

Julia.addComposeBox = function(element)
{
	$(element).html('<div class="compose-box"><div class="input-group mb-3"><input type="text" class="form-control" placeholder="write a message…"><div class="input-group-append"><button class="btn btn-primary" type="submit">send</button></div></div></div>');
	Julia.setEvents();
}

Julia.setEvents = function()
{
	$(".compose-box button").click(function(){

		Julia.getMessage();

	});

	$('.compose-box input').keypress(function(event){

		var keycode = (event.keyCode ? event.keyCode : event.which);

		if(keycode == '13')
		{
			Julia.getMessage();
		}

	});
}

Julia.showTyping = function()
{
	$(".chat-box").append('<div class="typing-box"><div class="lds-ellipsis"><div></div><div></div><div></div></div></div>');	
}

$(document).ready(function(){

	Julia.setEvents();

});