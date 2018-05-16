<?php
class NewUserForm extends DbConn
{
    public function createUser($usr, $email, $fname, $lname, $pw, $verified, $hash )
    {
        try {

            $db = new DbConn;
            $tbl_members = 'teachers';
            // prepare sql and bind parameters
	    
            $stmt = $db->conn->prepare("INSERT INTO teachers (username, email, first_name, last_name, password, verified, hash) 
		VALUES (:username, :email, :first_name, :last_name, :password, :verified, :hash)");
            $stmt->bindParam(':username', $usr);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':first_name', $fname);
            $stmt->bindParam(':last_name', $lname);
	    $stmt->bindParam('verified', $verified);
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


}
