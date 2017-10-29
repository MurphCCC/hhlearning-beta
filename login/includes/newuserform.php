<?php
class NewUserForm extends DbConn
{
    public function createUser($usr, $email, $fname, $lname, $pw, $hash )
    {
        try {

            $db = new DbConn;
            $tbl_members = 'teachers';
            // prepare sql and bind parameters
            $stmt = $db->conn->prepare("INSERT INTO ".$tbl_members." (username, email, first_name, last_name, password, hash )
            VALUES (:username, :email, :first_name, :last_name, :password, :hash)");
            $stmt->bindParam(':username', $usr);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':first_name', $fname);
            $stmt->bindParam(':last_name', $lname);
            $stmt->bindParam(':password', $pw);
            $stmt->bindParam(':hash', $hash);

            $stmt->execute();

            $err = '';

        } catch (PDOException $e) {

            $err = "Error: " . $e->getMessage();

        }
        //Determines returned value ('true' or error code)
        if ($err == '') {

            $success = 'true';

        } else {

            $success = $err;

        };

        return $success;

    }

        public function resetPass($teacher_id, $password )
    {
        try {

            $db = new DbConn;
            $tbl_members = 'teachers';
            // prepare sql and bind parameters
            $stmt = $db->conn->prepare("UPDATE TABLE ".$tbl_members." SET `password` = :pass WHERE `teacher_id` = :tid");
            $stmt->bindParam(':pass', $pass);
            $stmt->bindParam(':tid', $tid);
            $stmt->execute();

            $err = '';

        } catch (PDOException $e) {

            $err = "Error: " . $e->getMessage();

        }
        //Determines returned value ('true' or error code)
        if ($err == '') {

            $success = 'true';

        } else {

            $success = $err;

        };

        return $success;

    }
}

Class ResetUser extends DbConn
{
    public function resetPass($uid, $pass) 
    {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        try {
            $vdb = new DbConn;
            $tbl_members = $vdb->tbl_members;
            $verr = '';

        // prepare sql and bind parameters
        $vstmt = $vdb->conn->prepare('UPDATE '.$tbl_members.' SET password = :pass WHERE hash = :uid');
            $vstmt->bindParam(':uid', $uid);
            $vstmt->bindParam(':pass', $pass);
            $vstmt->execute();

        } catch (PDOException $v) {

            $verr = 'Error: ' . $v->getMessage();

        }

    //Determines returned value ('true' or error code)
    $resp = ($verr == '') ? 'true' : $verr;

        return $resp;

    }

}
    