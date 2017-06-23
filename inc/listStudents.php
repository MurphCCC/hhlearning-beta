<?php

require 'db-config.php';

$sql = 'SELECT `first_name`, `last_name`, `student_id` FROM `students` LIMIT 500';
$stmt = $db_con->prepare($sql);
$stmt->execute();
// $stmt->bindParam(':id', $_SESSION['teacher_id'], PDO::PARAM_INT);

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);


$student_list = array('data' => $students);

file_put_contents('../assets/students.json', json_encode($student_list));

echo 'Student list generated succesfully';


if (isset($_POST)) {

  require 'db-config.php';

  $sql = 'SELECT `first_name`, `last_name`, `student_id` FROM `students` LIMIT 500';
  $stmt = $db_con->prepare($sql);
  $stmt->execute();
  // $stmt->bindParam(':id', $_SESSION['teacher_id'], PDO::PARAM_INT);

  $students = $stmt->fetchAll(PDO::FETCH_ASSOC);


  $student_list = array('data' => $students);

  file_put_contents('../assets/students.json', json_encode($student_list));

  echo 'Student list generated succesfully';

}

?>
