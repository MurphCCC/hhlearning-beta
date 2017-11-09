<?php
require 'includes/functions.php';
include_once 'config.php';


if (isset($_REQUEST['resetRequest'])) {
    $remail = $_REQUEST['email'];
    $vdb = new DbConn;

        $stmt = $vdb->conn->prepare('SELECT * FROM `teachers` WHERE email = :email');
        $stmt->bindParam(':email', $remail);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $t = $stmt->fetch();

        if ($t === false) {
            echo 'Sorry that email address is not in the system';
            die();
        }
        $stmt = null;
        $vdb = null;



    // Send verification email
        $m = new MailSender;

        $m->sendMail($t->email, $t->username, $t->hash, 'ResetPass');
            echo 'Email sent';
            die();


} else if (isset($_REQUEST['pw'])) {
//Pull username, generate new ID and hash password
        $teacher_id = $_REQUEST['uid'];
        $newpw = password_hash($_REQUEST['pw'], PASSWORD_DEFAULT);
        $a = new ResetUser;
        $response = $a->resetPass($teacher_id, $newpw);
        // Success
        if ($response == 'true') {
            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'. $passwordResetSuccess .'</div><div id="returnVal" style="display:none;">true</div>';
            //Send verification email
            $m = new MailSender;
            $m->sendMail($newemail, $newuser, $newid, 'Verify');
        } else {
            //Failure
            mySqlErrors($response);
        }
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
  color: #3a6ea8;
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

h2.successMessage {
    background: rgba(192, 192, 192, 0.77);
    border-radius: 10px;
    padding: 10px;
    text-align: center;
}
    </style>
  </head>

  <body>

    <div class="login-page">

        <div class="form" id="form">
            <img src="https://hhlearning.com/wp-content/uploads/2017/04/cropped-HH-Logo.png" width="100px" height="100px"></img><h2>Hilger Grades</h2>
            <form class="form">
            <input type="password" name="password" id="password" placeholder="Enter your new Password"/>
            <input type="hidden" id="uid" name="uid" value="<?php echo $_REQUEST['uid']; ?>"/>
            <button id="submitform" name="submitform" value="submit">Reset</button>


                <div class="message"></div>

            </form>
        </div>
    </div>

</body>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-2.2.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
<script>
    $('#submitform').click(function(e){
    e.preventDefault();
    pw = $('#password').val();
    uid = $('#uid').val();

  

  $.ajax("resetpass.php?r1=true&pw=" + pw + "&uid=" + uid,
      {
          type: "POST",
          success: function(html) {
            console.log(html);
            $('.message').html(html);

          }
      },
      function(data, status){
      });
  
  });
</script>
</html>
