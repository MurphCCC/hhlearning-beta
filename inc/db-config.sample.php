<?php

try {
        $db_con = new PDO('mysql:host=127.0.0.1;dbname=DATABASE', 'USER', 'PASSWORD');
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
        echo $e->getMessage();
}
?>
