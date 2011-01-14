function submit_it(){
	var c=$(".resizable").val();
	var a=$(".drop").val();
	var b=$("#password").val();
	var e=$("#codetitle").val();
	
	if(c===""){
		$("#error").html("You didn't enter a code sample!");
		$("#error").slideDown("fast")
	}else{
		$("#error").slideUp("fast");
		$("form").slideUp("slow");
		$(".body").html('<center><img src="images/ajax-loader.gif" /></center>');
		$.post("includes/parser.php",{code:c,drop:a,password:b,codetitle:e}, function(d){ $(".body").html(d); });
	}
}
		
function extra() {
	$(".extra").slideToggle("slow");
}

function submit_contact() {
	var email = document.form1.email.value;
	var fullname = document.form1.name.value;
	var message = document.form1.message.value;
	
	if(email=="") {
		$("#error").html("Please enter a valid email address.");
		$("#error").slideDown("fast");
		return;
	}

	if(fullname=="") {
		$("#error").html("Please enter your name.");
		$("#error").slideDown("fast");
		return;
	}

	if(message=="") {
		$("#error").html("Please enter the message you'd like to send us.");
		$("#error").slideDown("fast");
		return;
	}
	
	$("#error").slideUp("fast");
	$.post("includes/sendmessage.php",
		   {email:email, name:fullname, message:message}, function(d){ $(".textbox2").html(d); });	
}