<?php

if (isset($_POST)) {

  require 'db-config.php';

	$sql = 'SELECT * FROM `teachers`';
	$st = $db_con->prepare($sql);
	$st->execute();
	$teachers = $st->fetchAll(PDO::FETCH_ASSOC);

    var_dump($teachers);


  $teacher_list = array('data' => $teachers);

  file_put_contents('../assets/teachers.json', json_encode($teachers));

  echo 'Teacher list generated succesfully';

}

?>