$(document).ready(function(){

  $("button#sign_submit").click(function(){

    var username = $("#first_name").val() + $("#last_name").val();
    var password = $("#password1").val();
    var password2 = $("#password2").val();
    var email = $("#email").val();
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();

    if((username == "") || (password == "") || (email == "")) {
      $("#create_message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Please enter a username and a password</div>");
    }
    else {
      $.ajax({
        type: "POST",
        url: "createuser.php",
        data: "newuser="+username+"&password1="+password+"&password2="+password2+"&email="+email+"&first_name="+first_name+"&last_name="+last_name,
        success: function(html){

			var text = $(html).text();
			//Pulls hidden div that includes "true" in the success response
			var response = text.substr(text.length - 4);

          if(response == "true"){

			$("#create_message").html(html);

					$('#submit').hide();
			}
		else {
			$("#create_message").html(html);
			$('#submit').show();
			}
        },
        beforeSend: function()
        {
          $("#create_message").html("<p class='text-center'><img src='images/ajax-loader.gif'></p>")
        }
      });
    }
    return false;
  });
});
