<?php
$conn    =   new PDO("mysql:host=localhost;dbname=hhlearning_grades", "hhlearning_grades", "Romans:33#", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    if (isset($_REQUEST['test'])) {
        echo 'Set';
        //Note the prepare on the outside.
        $stmt = $conn->prepare("UPDATE `courses` SET `course_name` = :course_name,
        `grade` = :grade,
        `feedback` = :feedback
         WHERE `id` = :id");
        //As well as the binding. By using bindParam, and supplying a variable, we're passing it by reference.
        //So whenever it changes, we don't need to bind again.
        $stmt->bindParam(":course_name", $_REQUEST['course_name'], PDO::PARAM_STR);
        $stmt->bindParam(":grade", $_REQUEST['grade'], PDO::PARAM_STR);
        $stmt->bindParam(":feedback", $_REQUEST['feedback'], PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        var_dump($_REQUEST);
        foreach ($_REQUEST['grade'] as $value) {
            echo $value;
            
        }
        // foreach ($_REQUEST['course_name'] as $index => $comment) {

        //     //All that's left is to set the ID, see how we're reusing the $index of the comment input?

        //     $id = $_REQUEST['id'][$index];

        //     $stmt->execute();

        // }
    } else {
        echo 'Nothing set';
    }
?>