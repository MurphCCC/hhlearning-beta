<?php
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';

echo __DIR__ . '/vendor/autoload.php';

// Create an instance of the class:
// $mpdf = new mPDF();
$mpdf = new mPDF('c','A4','','',10,10,9,25,10,10); //1st digit is left margin, third digit is top margin of page
$student_name = 'Mike Conrad';

// . is a class, # is an id
$html = '
<html>
	<head>
		<style>
		h1.report-heading {
			font-size:20px;
		}
		h2.report-heading {
			font-size: 14px;
			font-weight: 100;
		}
		.header {
			text-align: center;

		}
		.intro {
			padding-top: 75px;
		}
		</style>
	</head>
		<body>
			<div class="header">
				<h1 class="report-heading">Hilger Higher Learning Report Card</h1>
				<h2 class="report-heading">Hilger Higher Learning, Inc.</h2>
				<h2 class="report-heading">1121 Mountain Terrace</h2>
				<h2 class="report-heading">Lookout Mountain, GA 30750</h2>
				<h2 class="report-heading">www.hhlearning.com</h2>
			</div>

			<div class="intro">
			'.$student_name.'	has received the following percentage grade(s) for one semester of class(es) administered by Hilger Higher Learning, Inc. All instructors contracted by Hilger Higher Learning meet proper Certification and/or requirement standards as directed by Tennessee, Georgia, and Alabama state law. Each semester of class is worth 1/2 credit.
			</div>
			';
			foreach ($courses as $course) {

				echo '<div class="course">';
				echo 'Course: ' . $course['name'] . '<br />';
				echo 'Grade: ' . $course['grade'] . '<br />';
				echo 'Instructor ' . $course['teacher'] . '<br />';
			}
			echo '
		</body>
</html>

';

// Write some HTML code:
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output();
