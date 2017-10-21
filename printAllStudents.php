<?PHP
// var_dump($_REQUEST);
// var_dump($_SESSION);
//Include PDF class
require_once('./fpdf.php');
require('inc/db-config.php');

class PDF extends FPDF
{

    var $custom_number = 1;
    var $student       = null;

    // Page header
    function Header()
    {

        if ($this->getPageNumber() == 1) {

            // Logo
            $this->Image('assets/img/grade_print_logo.jpg',10,6,45);

            $this->SetFont('Arial','B',14);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30,5,'Hilger Higher Learning Report Card',0,1,'C');

            //Set font for subtitle
            $this->SetFont('Times','',12);
            $this->Cell(80);
            $this->Cell(30,8,'Hilger Higher Learning, Inc.',0,1,'C');
            $this->Cell(80);
            $this->Cell(30,8,'1121 Mountain Terrace',0,1,'C');
            $this->Cell(80);
            $this->Cell(30,8,'Lookout Mountain, GA 30750',0,1,'C');
            $this->Cell(80);
            $this->Cell(30,8,'www.hhlearning.com',0,1,'C');

            // Line break
            $this->Ln(20);
        }
        else {

            $this->SetFont('Times','I',8);
            $this->Cell(150);
            $this->Cell(30,8, 'Page : ' . $this->getPageNumber() ,0,1,'R');
        }
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);

        $this->SetFont('Times','I',8);
        // Page number
        //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        $this->Cell(0,10,'Hilger Higher Learning',0,0,'C');
        $this->Cell(0,10,'Report Card for '.$this->getStudent() ,0,0,'R');
    }

    function setPageNumber($number){
        $this->custom_number = $number;
    }

    function getPageNumber() {
        return $this->custom_number;
    }

    function customAddPage(){
        $this->AddPage();
        $this->setPageNumber(1);
    }

    function AcceptPageBreak() {

        //Override this function to keep track of page numbers for students
        $page_number = $this->getPageNumber();
        $page_number++;
        $this->setPageNumber($page_number);

        return $this->AutoPageBreak;
    }

    function getStudent() {
        return $this->student;
    }

    function setStudent($student){
        $this->student = $student;
    }
}   

    if(isset($_REQUEST['print']) && $_REQUEST['print'] === 'all') {
            // Select all students from and courses from the database, put the courses in order of student id and bring in teacher names as well
     $statement = $db_con->prepare("SELECT teachers.first_name AS tFirst, 
            teachers.last_name AS tLast, 
            courses.course_name AS cName, 
            courses.id AS cId, 
            courses.grade AS cGrade, 
            courses.feedback AS cFeedback, 
            students.first_name AS sFirst,
            students.last_name AS sLast,
            students.student_id AS sId
                FROM courses 
                    INNER JOIN teachers on courses.teacher_id = teachers.teacher_id
                    INNER JOIN students on courses.student_id = students.student_id
                        ORDER BY courses.student_id");
     $statement->execute();
 } else {
         $statement = $db_con->prepare("SELECT teachers.first_name AS tFirst, 
            teachers.last_name AS tLast, 
            courses.course_name AS cName, 
            courses.id AS cId, 
            courses.grade AS cGrade, 
            courses.feedback AS cFeedback, 
            students.first_name AS sFirst,
            students.last_name AS sLast,
            students.student_id AS sId
                FROM courses 
                    INNER JOIN teachers on courses.teacher_id = teachers.teacher_id
                    INNER JOIN students on courses.student_id = students.student_id
                        WHERE courses.student_id = :student_id
                            ORDER BY courses.student_id");
         $statement->bindParam(':student_id', $_REQUEST['print'], PDO::PARAM_STR);
         $statement->execute();
         // var_dump($_REQUEST);
 }

     // $statement->execute(array(':student_id' => 0));
     $student = $statement->fetchAll(PDO::FETCH_ASSOC);
     $pdf = new PDF();

        if ($student) {

            //Set an initial variable for our student id.  We will check this on each iteration of the foreach loop to determine if we need to move
            // onto the next student or not.  We update this at the end of each iteration using the current student_id.
            $current_student = $student[0]['sId'];
            $pdf->customAddPage();

            foreach ($student as $row) {

                // Check to see if we are still working on the same student as in the previous loop.  If so, no need to start a new page.
                if ($current_student === $row['sId']) {


                $student = $row['sFirst'] . ", " . $row['sLast'];
                $student_header = $row['sFirst'] . " " . $row['sLast'];
                $pdf->setStudent($student);
                $pdf->SetFont('Times','',10);
                $intro = $student_header . " has received the following  percentage grade(s) for one " .
                         "semester of class(es) administered by Hilger Higher Learning, Inc. All instructors contracted by Hilger " .
                         "Higher Learning meet proper Certification and/or requirement standards as directed by Tennessee, Georgia, ".
                         "and Alabama state law. Each semester of class is worth 1/2 credit.";

                $pdf->Cell(10);
                $pdf->Write(5, $intro);

                $i = 1;
                $pdf->Ln(5);

                    # code...                        $pdf->Ln(5);
                        // echo $next_course;
                        if (!empty($row['cName'])) {
                            $pdf->SetFont('Times','B',10);
                            $pdf->Cell(10);
                            $course = "Course: " . $row['cName'];
                            $course = iconv('UTF-8', 'windows-1252', trim($course));
                            $pdf->Cell(0,5,$course,0,1,'L');

                            $pdf->Ln(1);

                            $pdf->Cell(10);
                            $grade = "Grade: " . $row['cGrade'];
                            $grade = iconv('UTF-8', 'windows-1252', trim($grade));
                            $pdf->Cell(0,5,$grade,0,1,'L');

                            $pdf->Ln(1);

                            $pdf->Cell(10);
                            $teacher = "Instructor: " . $row['tFirst'] . ' ' . $row['tLast'];
                            $teacher = trim($teacher);
                            $teacher = iconv('UTF-8', 'windows-1252', ucwords($teacher));
                            $pdf->Cell(0,5,$teacher,0,1,'L');

                            $pdf->Ln(1);

                            $pdf->SetFont('Times','',10);
                            $pdf->Cell(10);
                            $feedback = trim($row['cFeedback']);
                            $feedback = iconv('UTF-8', 'windows-1252', $feedback); //Ensure that were getting correct punctation in the pdf output.  Without this punctuation will be converted to funky characters.
                            $pdf->Write(5, $feedback);
                            $pdf->Ln(10);
                            $current_student = $row['sId'];

                        };
                } else {    //If we are moving onto the next student, we need to add a new page.
                $pdf->customAddPage();

                $student = $row['sFirst'] . ", " . $row['sLast'];
                $student_header = $row['sFirst'] . " " . $row['sLast'];
                $pdf->setStudent($student);
                $pdf->SetFont('Times','',10);
                $intro = $student_header . " has received the following  percentage grade(s) for one " .
                         "semester of class(es) administered by Hilger Higher Learning, Inc. All instructors contracted by Hilger " .
                         "Higher Learning meet proper Certification and/or requirement standards as directed by Tennessee, Georgia, ".
                         "and Alabama state law. Each semester of class is worth 1/2 credit.";

                $pdf->Cell(10);
                $pdf->Write(5, $intro);

                $i = 1;
                $pdf->Ln(5);

                    # code...                        $pdf->Ln(5);
                        // echo $next_course;
                        if (!empty($row['cName'])) {
                            $pdf->SetFont('Times','B',10);
                            $pdf->Cell(10);
                            $course = "Course: " . $row['cName'];
                            $course = iconv('UTF-8', 'windows-1252', trim($course));
                            $pdf->Cell(0,5,$course,0,1,'L');

                            $pdf->Ln(1);

                            $pdf->Cell(10);
                            $grade = "Grade: " . $row['cGrade'];
                            $grade = iconv('UTF-8', 'windows-1252', trim($grade));
                            $pdf->Cell(0,5,$grade,0,1,'L');

                            $pdf->Ln(1);

                            $pdf->Cell(10);
                            $teacher = "Instructor: " . $row['tFirst'] . ' ' . $row['tLast'];
                            $teacher = trim($teacher);
                            $teacher = iconv('UTF-8', 'windows-1252', ucwords($teacher));
                            $pdf->Cell(0,5,$teacher,0,1,'L');

                            $pdf->Ln(1);

                            $pdf->SetFont('Times','',10);
                            $pdf->Cell(10);
                            $feedback = trim($row['cFeedback']);
                            $feedback = iconv('UTF-8', 'windows-1252', $feedback); //Ensure that were getting correct punctation in the pdf output.  Without this punctuation will be converted to funky characters.
                            $pdf->Write(5, $feedback);
                            $pdf->Ln(10);
                                                        $current_student = $row['sId'];


                        };
                    };


                $pdf->setPageNumber(1); //Reset page counter
                
            }
          }

$pdf->AliasNbPages();
$pdf->SetTitle('Hilger Higher Learning - All Grade Reports');
$pdf->Output();