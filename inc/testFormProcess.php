<?php

//Include our database configuration file
require 'db-config.php';

$course_name = $_REQUEST['course_name'];
$grade = $_REQUEST['grade'];
$feedback = $_REQUEST['feedback'];
$teacher_id = $_REQUEST['teacher_id'];
$student_id = $_REQUEST['student_id'];



if (isset($_REQUEST['update']) && $_REQUEST['update'] === "true") {
    //This course already exists in our database so we need to run an update function

    $sql = "UPDATE courses SET course_name = :course_name, 
            grade = :grade, 
            feedback = :feedback   
            WHERE id = :id";
        $stmt = $db_con->prepare($sql);                                  
        $stmt->bindParam(':course_name', $_REQUEST['course_name'], PDO::PARAM_STR);       
        $stmt->bindParam(':grade', $_REQUEST['grade'], PDO::PARAM_STR);    
        $stmt->bindParam(':feedback', $_REQUEST['feedback'], PDO::PARAM_STR);   
        $stmt->bindParam(':id', $_REQUEST['id'], PDO::PARAM_INT);   
        $stmt->execute();
echo 'Row successfully updated';

} //end of isset update

if (isset($_REQUEST['create']) && $_REQUEST['create'] === "true") {
    //This course does not exist in our database so we need to run a create function
      try {
          $statement = $db_con->prepare("INSERT INTO courses(course_name, grade, feedback, teacher_id, student_id)
              VALUES(:course_name, :grade, :feedback, :teacher_id, :student_id)");
          $statement->execute(array(
              "course_name" => $course_name,
              "grade" => $grade,
              "feedback" => $feedback,
              "teacher_id" => $teacher_id,
              "student_id" => $student_id

          ));
            echo 'Course added sucessfully!';

    } catch(PDOException $e) {
            echo $e->getMessage();
    }

}


 ?>
