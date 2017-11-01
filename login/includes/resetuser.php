<?php


Class ResetUser extends DbConn
{

        public function resetPass($uid, $pass) 
    {
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


    };






?>
