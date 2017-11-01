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

        
} else if (isset($_REQUEST['password'])) {
//Pull username, generate new ID and hash password
        $teacher_id = $_REQUEST['uid'];
        $newpw = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
        $password = $_REQUEST['password'];
        file_put_contents('test.pass', $newpw);
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
<form method="GET" action="">
<input type="password" name="password" id="password" placeholder="Please set a new password"/>
<input type="hidden" name="uid" value="<?php echo $_REQUEST['uid']; ?>"/> 
<button type="submit" name="submit" value="submit">Submit</button>
</form>



