<?php

//Include our database configuration file
require 'db-config.php';

//Student name variables



/*
* Code to add a student to the database.  This is mostly used by our admin users.  This entry should be added
* to our students table in the database.  We are only accepting a first and last name for the student.
* A student_id will automatically be added.
*/

if (isset($_POST['action']) && $_POST['action'] === 'add') {  //Add student to database
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];

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

if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'editCourse') {
  // $sqlQuery = "UPDATE courses SET course_name = :cname,
  //       grade = :cgrade,
  //       feedback  = :feedback,
  //       WHERE `id` ='4'";
  // $run = $db_con->prepare($sqlQuery);
  // // $run->bindParam(':course_id', $_REQUEST['course_id'], PDO::PARAM_STR);
  // $run->bindParam(':cname', $_REQUEST['cname'], PDO::PARAM_STR);
  // $run->bindParam(':cgrade', $_REQUEST['cgrade'], PDO::PARAM_STR);
  // $run->bindParam(':feedback', $_REQUEST['feedback'], PDO::PARAM_STR);
  //
  // $run->execute();
  //
  //
  //
  //             if (!$run) {
  //         echo "\nPDO::errorInfo():\n";
  //         print_r($db_con->errorInfo());
  //     }
      // echo $first_name . ' ' . $last_name . ' ' . ' has been Updated Successfully <br />';
      $stmt = $db_con->prepare("UPDATE courses SET course_name=?, grade=?, feedback=? WHERE id=?");
      $stmt->execute(array($_REQUEST['cname'], $_REQUEST['cgrade'],$_REQUEST['feedback'], $_REQUEST['course_id'] ));
      $affected_rows = $stmt->rowCount();

      echo $_REQUEST['cname'].' Updated Successfully!';
}










 ?>
