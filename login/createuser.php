<?php
require 'includes/functions.php';
include_once 'config.php';
require_once 'includes/newuserform.php';
//Pull username, generate new ID and hash password
$newid = uniqid(rand(), false);
$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$newuser = $fname . ' ' . $lname;
$newpw = password_hash($_POST['password1'], PASSWORD_DEFAULT);
$verified = '1';
$pw1 = $_POST['password1'];
$pw2 = $_POST['password2'];
$pw1 = $newpw;
$pw2 = $pw1;
$hash = $newid;
$newemail = $_POST['email'];

    //Enables moderator verification (overrides user self-verification emails)
if (isset($admin_email)) {
    $newemail = $admin_email;
} else {
    $newemail = $_POST['email'];
}
//Validation rules
if ($pw1 != $pw2) {
    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password fields must match</div><div id="returnVal" style="display:none;">false</div>';
} elseif (strlen($pw1) < 4) {
    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password must be at least 4 characters</div><div id="returnVal" style="display:none;">false</div>';
} elseif (!filter_var($newemail, FILTER_VALIDATE_EMAIL) == true) {
    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Must provide a valid email address</div><div id="returnVal" style="display:none;">false</div>';
} else {
    //Validation passed
    if (isset($_POST['password1']) && !empty(str_replace(' ', '', $_POST['password1']))) {
        //Tries inserting into database and add response to variable
        $a = new NewUserForm;
        $response = $a->createUser($newuser, $newemail, $fname, $lname, $newpw, $verified, $hash);
        //Success
        if ($response == 'true') {
            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'. $signupthanks .'</div><div id="returnVal" style="display:none;">true</div>';
            //Send verification email
            $m = new MailSender;
            $m->sendMail($newemail, $newuser, $newid, 'Verify');
        } else {
            //Failure
            mySqlErrors($response);
        }
    } else {
        //Validation error from empty form variables
        echo 'An error occurred on the form... try again';
    }
};
