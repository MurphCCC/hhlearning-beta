<?php

//Include our database configuration file
require 'db-config.php';

//Student name variables



/*
* Code to add a student to the database.  This is mostly used by our admin users.  This entry should be added
* to our students table in the database.  We are only accepting a first and last name for the student.
* A student_id will automatically be added.
*/

if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'deleteStudent') {
  try {
    $q = $db_con->prepare("DELETE FROM `students` WHERE `student_id` = :id");
    $q->bindValue(':id', $_REQUEST['student_id']);
    $q->execute();

    $sql = 'SELECT `first_name`, `last_name`, `student_id` FROM `students` LIMIT 500';
$stmt = $db_con->prepare($sql);
$stmt->execute();
// $stmt->bindParam(':id', $_SESSION['teacher_id'], PDO::PARAM_INT);

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);


$student_list = array('data' => $students);

file_put_contents('../assets/students.json', json_encode($student_list)); 
  } catch(PDOException $e) {
      echo $e->getMessage();
  }
    echo 'Student deleted sucessfully';

}
if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'add') {  //Add student to database
  $fname = $_REQUEST['fname'];
  $lname = $_REQUEST['lname'];

    try {
          $statement = $db_con->prepare("INSERT INTO students(first_name, last_name)
              VALUES(:fname, :lname)");
          $statement->execute(array(
              "fname" => $fname,
              "lname" => $lname
          ));
            echo 'Student '.$fname.' '.$lname.' added sucessfully!';

    } catch(PDOException $e) {
            echo $e->getMessage();
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'addCourse') {  //Add student to database
  $teacher_id = $_REQUEST['teacher_id'];
  $student_id = $_REQUEST['student_id'];


    try {
          $statement = $db_con->prepare("INSERT INTO courses(course_name, grade, feedback, teacher_id, student_id)
              VALUES(:cname, :cgrade, :feedback, :teacher_id, :student)");
          $statement->execute(array(
              "cname" => $_REQUEST['cname'],
              "cgrade" => $_REQUEST['cgrade'],
              "feedback" => $_REQUEST['feedback'],
              "teacher_id" => $_REQUEST['teacher_id'],
              "student" => $_REQUEST['student_id']
          ));
            // echo 'Student '.$fname.' '.$lname.' added sucessfully!';
            echo $_REQUEST['cname'].' added successfully!';

    } catch(PDOException $e) {
            echo $e->getMessage();
    }
}
// We need to test if the course id is set and not empty.  If it is set and contains a number, this means that this chunk of the form is referring to .

if(isset($_POST['update'])) {
    echo "Update " . $_POST['id_update'] . $_POST['course_name'] . $_POST['grade'] . $_POST['feedback'] . '<-- This is the result of clicking update for each row';


    $sql = "UPDATE courses SET course_name = :course_name, 
            grade = :grade, 
            feedback = :feedback   
            WHERE id = :id";
        $stmt = $db_con->prepare($sql);                                  
        $stmt->bindParam(':course_name', $_POST['course_name'], PDO::PARAM_STR);       
        $stmt->bindParam(':grade', $_POST['grade'], PDO::PARAM_STR);    
        $stmt->bindParam(':feedback', $_POST['feedback'], PDO::PARAM_STR);   
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);   
        $stmt->execute();
} //end of isset update

 ?>
