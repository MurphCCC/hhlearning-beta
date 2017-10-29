<?php
require 'includes/functions.php';
include_once 'config.php';
//Pull username, generate new ID and hash password
$teacher_id = $_POST['teacher_id'];
$newpw = password_hash($_POST['password1'], PASSWORD_DEFAULT);



        $a = new NewUserForm;
        $response = $a->resetPass($teacher_id, $newpw);
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

