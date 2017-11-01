<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
<!--     <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen"> -->

    <style>

@import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 560px;
  padding: 8% 0 0;
  margin: auto;
}

img {
  float: left;
    padding: 20px;
}
h2 {
  padding: 5px;
  float: left;
  font-size: 3em;
  text-align: center;
  font-family: "Cinzel";
  font-weight: 300;
}

.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 560px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}

.form input {
  text-align: center;
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  border-radius: 10px;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
  border: .5px solid black;

}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #396ea8;
  width: 100%;
  border: 1px solid white;
  border-radius: 10px;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #537ca9;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #396ea8;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #396ea8; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #396ea8, #396ea8);
  background: -moz-linear-gradient(right, #396ea8, #396ea8);
  background: -o-linear-gradient(right, #396ea8, #396ea8);
  background: linear-gradient(to left, #396ea8, #396ea8);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}

h3-status {
    font-size: 22px;
    padding: 10px;
    color: black;
    background: rgba(214, 210, 210, 0.71);
    border-radius: 10px;
    font-family: Roboto, "sans-serif";
}

    </style>
  </head>

  <body>

<div class="login-page">
  <div class="form">
    <img src="https://hhlearning.com/wp-content/uploads/2017/04/cropped-HH-Logo.png" width="100px" height="100px"></img><h2>Hilger Grades</h2>
    
    <!-- Registration Form -->
    <form class="register-form" id="usersignup" name="usersignup" method="post" action="createuser.php">
      <input name="first_name" id="first_name" type="text" placeholder="First Name"/>
      <input name="last_name" id="last_name" type="text" placeholder="Last Name"/>
      <input type="password" name="password1" id="password1" placeholder="Password" required/>
      <input type="password" name="password2" id="password2" placeholder="Repeat Password" required/>
      <input type="text" name="email" id="email" placeholder="Email Address" required/>
      <button>create</button>
      <p class="message message-signin">Already registered? <a href="#">Sign In</a></p>
    </form>
    <!-- End Registration Form -->

    <!-- Old registration form start -->
<!-- 
          <form class="form-signup" id="usersignup" name="usersignup" method="post" action="createuser.php">
        <h2 class="form-signup-heading">Register</h2>
        <input name="newuser" id="newuser" type="text" class="form-control" placeholder="Username" autofocus>
        <input name="email" id="email" type="text" class="form-control" placeholder="Email">
        <input name="first_name" id="first_name" type="text" class="form-control" placeholder="first_name">
        <input name="last_name" id="last_name" type="text" class="form-control" placeholder="Last Name">
        <input name="password1" id="password1" type="password" class="form-control" placeholder="Password">
        <input name="password2" id="password2" type="password" class="form-control" placeholder="Repeat Password">

        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>

        <div id="message"></div>

      </form> -->

      <!-- Old registration form end -->




    <!-- Login Form -->
    <form class="login-form">
      <input type="text" name="myusername" id="myusername" placeholder="Name"/>
      <input type="password" name="mypassword" id="mypassword" placeholder="Password"/>
      <button type="button" id="submit">login</button>
      <p class="message message-create">Not registered? <a href="#">Create an account</a></p>
      <p class="message message-reset"> <a href="#">Forgot Password?</a></p>
      <div class="message" id="message"></div>
    </form>

    <!-- Reset Password form -->
    <div class="reset-form" id="reset-form">
        <form class="reset-form">
      <input type="text" id="emailReset" placeholder="Email"/>
      <button id="reset">Enter your email</button>

      <div class="message"></div>
      
    </form>
    </div>  
    </div>
</div>


    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-2.2.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- The AJAX login script -->
    <script src="js/login.js"></script>
    <script>

//Hide our reset password form initially
$(document).ready(function(){
  $('#reset-form').hide()
})


$('.message-signin, .message-create a').click(function(){
   $('form').animate({ opacity: "toggle"}, "slow");
});


$('.message-reset').click(function(){
  $('#reset-form').show()
  $('#login-form').hide()
  $('form.login-form').hide()
});

  

$('#reset').click(function(){
  emailAddr = $('#emailReset').val();
  

  $.ajax("resetpass.php?resetRequest=true&email=" + emailAddr,
      {
          type: "GET",
          success: function(html) {
            console.log(html);
            $('.message').html('<h3-status>'+html+'</h3>');

          }
      },
      function(data, status){
          alert("Data: " + data + "\nStatus: " + status);
      });
  alert('hello');
  
  });
    




</script>

  </body>
</html>

