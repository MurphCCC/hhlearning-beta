<?php


Class ResetUser extends DbConn
{

        public function resetPass($uid, $pass) 
        {
            //$pass = password_hash($pass, PASSWORD_DEFAULT);
            try {
                $vdb = new DbConn;
                $tbl_members = $vdb->tbl_members;
                $verr = '';

            // prepare sql and bind parameters
            $vstmt = $vdb->conn->prepare('UPDATE '.$tbl_members.' SET password = :pass WHERE hash = :uid');
                $vstmt->bindParam(':uid', $uid);
                $vstmt->bindParam(':pass', $pass);
                $vstmt->execute();

                echo '<h2 class="successMessage">Password successfully reset. <br /> Click <a href="//grades.hhlearning.com"> Here</a> to login</h2>';
                $vdb = null;
                $vstmt = null;
                die();

            } catch (PDOException $v) {

                $verr = 'Error: ' . $v->getMessage();

            }

            //Determines returned value ('true' or error code)
            $resp = ($verr == '') ? 'true' : $verr;

                return $resp;

        }


    };






?>
