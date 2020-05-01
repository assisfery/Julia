var Julia = {};
Julia.apiUrl = "api/demo-chatbot";

Julia.hears = function(msg)
{
	$.ajax({
		type: "POST",
		url: Julia.apiUrl,
		data: JSON.stringify({ type: "text", content: msg }),
	})
	.done(function(data) {

		console.log(data.messages);
		Julia.says(data.messages);

	})
	.fail(function() {

		alert("error");

	});
}

Julia.says = function(msgs)
{
	for(var i = 0; i < msgs.length; i++)
	{
		$(".chat-box").append('<div class="message-box"><div>' + msgs[i].content + '</div></div>');
	}

	$('.chat-box').animate({scrollTop: $('.chat-box')[0].scrollHeight }, 1000);
}

$(document).ready(function(){

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

});

Julia.getMessage = function()
{
	var msg = $(".compose-box input").val();

	if(msg)
	{
		$(".compose-box input").val("");

		Julia.hears(msg);

		$(".chat-box").append('<div class="message-box message-box-2"><div>' + msg + '</div></div>');
	}

	$('.chat-box').animate({scrollTop: $('.chat-box')[0].scrollHeight}, 100);
}