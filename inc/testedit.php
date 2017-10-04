<?php

    /*
    * This is an example of a form with multiple fields, each one with its own update/submit button.
    */
    function UserForm($customers = array())
        { 
            ob_start(); ?>
            <form action="" method="post"><?php
                $ID = $customers['id']; ?>
                <tr>
                    <td><input type="text" name="course_name" value="<?php echo $customers['course_name']; ?>"></td>
                    <td><input type="text" name="grade" value="<?php echo $customers['grade']; ?>"</td>
                    <td><input type="text" name="feedback" value="<?php echo $customers['feedback']; ?>"</td>
                    <td align="center">
                        <input type="hidden" name="id" value="<?php echo $ID; ?>">
                        <input type="submit" name="delete" value="X">
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                    <input type="hidden" name="id_update" value="<?php echo $ID; ?>" />
                    <input type="submit" name="update" value="Edit Course" />
                    <?php echo $ID; ?><--This is the ID for each row -->
                    </td>
                </tr>
            </form>
            <?php
            $data   =   ob_get_contents();
            ob_end_clean();
            return $data;
        } ?>


<table class="table table-striped table-bordered table-responsive">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Delete</th>
        </tr>
    </thead>
<?php
$pdo    =   new PDO("mysql:host=localhost;dbname=hhlearning_grades", "hhlearning_grades", "Romans:33#", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$query  =   $pdo->prepare("select * from courses");
$query->execute();

while($customers = $query->fetch()){
    echo UserForm($customers);
}

// Delete customer
if(isset($_POST['delete'])) {
    try{
            $ID     =   $_POST['id'];
            $query  =   $pdo->prepare("DELETE FROM `courses` where id = :ID");
            $query->bindParam('id', $ID);
            $query->execute(array('id' => $ID));
            echo "Grades successfully deleted.";
            echo '<META http-equiv="refresh" content="1;URL=view_edit.php">';
        }catch(PDOException $e){
            echo "Failed to delete the MySQL database table ... :".$e->getMessage();
        } //end of try
    } //end of isset delete

// Logic to Edit student grades.
if(isset($_POST['update'])) {
    // echo "Update " . $_POST['id_update'] . $_POST['course_name'] . $_POST['grade'] . $_POST['feedback'] . '<-- This is the result of clicking update for each row';


    $sql = "UPDATE courses SET course_name = :course_name, 
            grade = :grade, 
            feedback = :feedback   
            WHERE id = :id";
        $stmt = $pdo->prepare($sql);                                  
        $stmt->bindParam(':course_name', $_POST['course_name'], PDO::PARAM_STR);       
        $stmt->bindParam(':grade', $_POST['grade'], PDO::PARAM_STR);    
        $stmt->bindParam(':feedback', $_POST['feedback'], PDO::PARAM_STR);   
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);   
        $stmt->execute();
} //end of isset update

?>
</table>