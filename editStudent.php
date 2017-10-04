<?php
require 'inc/header.php';
require 'inc/db-config.php';

$sql = 'SELECT * FROM `courses` WHERE `teacher_id` = :tid AND `student_id` = :sid';
$stmt = $db_con->prepare($sql);
$stmt->bindParam(':tid', $_SESSION['teacher_id'], PDO::PARAM_INT);
$stmt->bindParam(':sid', $_REQUEST['student_id'], PDO::PARAM_STR);
$stmt->execute();


$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM `students` WHERE `student_id` = :sid';
$st = $db_con->prepare($sql);
$st->bindParam(':sid', $_REQUEST['student_id'], PDO::PARAM_STR);
$st->execute();

$s = $st->fetchAll(PDO::FETCH_ASSOC);
print_r($s);
$name = print_r($s);

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

    function UserForm($customers = array())
        { 
            ob_start(); ?>
            <form action="" method="POST"><?php
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
        }

?>

		<!-- END HEADER-->

		<!-- BEGIN BASE-->
		<div id="base">
			<!-- WE NEED THIS BLOCK IN ORDER FOR OUR OFFCANVAS ELEMENT LATER IN THE PAGE TO WORK -->
			<div class="offcanvas"></div>
				<!-- BEGIN BLANK SECTION -->
				<section>
					<div class="section-header">
						<ol class="breadcrumb">
							<li><a href="#">Home</a></li>
							<li class="active">All Students</li>
						</ol>
					</div><!--end .section-header -->
					<div class="section-body">
						<button type="button" class="btn btn-info addsection">Add a blank course</button>
						<!-- sheepIt Form -->

						<?php  
						//sizeof($courses) should return then number of courses a student has been assigned.  If this number is 0, then we want to display a form, and when the teacher submits it, it should create the first course for this student/teacher combo, else we should have an edit button for each entry.
						if(sizeof($courses) === 0) {
							addCourse();
						} else {
							$i = 0;
							foreach ($courses as $c) {
								echo UserForm($c);
								// echo '
								// <!-- BEGIN INTRO -->
								// <div class="row">
								// 	<div class="col-lg-12">
								// 		<h1 class="text-primary">'.$name.'</h1>
								// 	</div><!--end .col -->
								// 	<div class="col-lg-8">
								// 		<article class="margin-bottom-xxl">
								// 			<p class="lead">
								// 				Enter students first and last name and click \'Submit\'
								// 			</p>
								// 		</article>
								// 	</div><!--end .col -->
								// </div><!--end .row -->
								// <!-- END INTRO -->
								// <!-- BEGIN BASIC ELEMENTS -->
								// <div class="row">
								// <div id="sections">
								// <div class="section">
								// 	<div class="col-lg-offset-1 col-md-10 col-sm-6" >
								// 		<div class="card">
								// 			<div class="card-body">
								// 				<form class="form" id="edit" action="">
								// 				<div class="form-group">
								// 					<input type="hidden" name="teacher_id" class="form-control" id="teacher_id" value="'. $_SESSION['teacher_id'] .'">
								// 					<input type="hidden" name="student_id" class="form-control" id="student_id" value="'. $_REQUEST['student_id'] .'">
								// 					<input type="hidden" name="course_id" class="form-control" id="course_id" value="'.$c['id'].'">

								// 				</div>
								// 					<div class="form-group">
								// 						<input type="text" name="course_name" class="form-control" id="course_name" value="'.$c['course_name'].'">
								// 						<label for="cname">Course Name</label>
								// 					</div>
								// 					<div class="form-group">
								// 						<input type="text" name="grade" class="form-control" id="grade" value="'.$c['grade'].'">
								// 						<label for="cgrade">Course Grade</label>
								// 					</div>
								// 					<div class="form-group">
								// 						<textarea name="feedback" rows="4" class="form-control" id="feedback" value="'.$c['feedback'].'">'.$c['feedback'].'</textarea>
								// 						<label for="feedback">Feedback</label>
								// 					</div>
								// 					<div class="form-group">
								// 						<button type="button" class="btn btn-success" name="edit'.$c['id'].'" id="editCourse'.$c['id'].'"">Edit Course</button>
								// 				</form>

								// 			</div>
								// 			</div><!--end .card-body -->

								// 		</div><!--end .card -->

								// 	</div><!--end .col -->
								// 	<div class="col-lg-offset-1 col-md-6 col-sm-6" id="success"></div>

								// </div><!--end .row -->
								// </div>
								// </div>
								// <!-- END BASIC ELEMENTS -->



								// ';

								$i++;
							}
						}
						?>

  <!-- /Controls -->

</div>
<!-- /sheepIt Form -->
					</div>
				</div>
				</section>



				<!-- BEGIN BLANK SECTION -->
			</div><!--end #content-->
			<!-- END CONTENT -->

			<!-- BEGIN MENUBAR-->
			<div id="menubar" class="menubar-inverse ">
				<div class="menubar-fixed-panel">
					<div>
						<a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
							<i class="fa fa-bars"></i>
						</a>
					</div>
					<div class="expanded">
						<a href="html/dashboards/dashboard.html">
							<span class="text-lg text-bold text-primary ">MATERIAL&nbsp;ADMIN</span>
						</a>
					</div>
				</div>
				<div class="menubar-scroll-panel">

			<!-- BEGIN MAIN MENU -->
			<?php include('inc/menu.php'); ?>
			<!-- END MENUBAR -->


			<!-- BEGIN OFFCANVAS RIGHT -->
			<!-- Let's use this section to list all of the students assigned to a teacher. -->
			<div class="offcanvas">

				<!-- BEGIN OFFCANVAS SEARCH -->
				<div id="offcanvas-search" class="offcanvas-pane width-8">
					<div class="offcanvas-head">
						<header class="text-primary">Search</header>
						<div class="offcanvas-tools">
							<a class="btn btn-icon-toggle btn-default-light pull-right" data-dismiss="offcanvas">
								<i class="md md-close"></i>
							</a>
						</div>
					</div>
					<div class="offcanvas-body no-padding">
						<ul class="list ">
							<li class="tile divider-full-bleed">
								<div class="tile-content">
									<div class="tile-text"><strong>Students</strong></div>
								</div>
							</li>

							<!-- We only need one of these code blocks as we can generate this with a PHP function in a loop. -->
							<li class="tile">
								<a class="tile-content ink-reaction" href="#offcanvas-chat" data-toggle="offcanvas" data-backdrop="false">
									<div class="tile-icon">
										<img src="../../assets/img/avatar4.jpg?1404026791" alt="" />
									</div>
									<div class="tile-text">
										Alex Nelson
										<small>123-123-3210</small>
									</div>
								</a>
							</li>
							<!-- End of our code block for a student. -->


						</ul>
					</div><!--end .offcanvas-body -->
				</div><!--end .offcanvas-pane -->
				<!-- END OFFCANVAS SEARCH -->


							</li>
						</ul>
					</div><!--end .offcanvas-body -->
				</div><!--end .offcanvas-pane -->
				<!-- END OFFCANVAS CHAT -->

			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS RIGHT -->

		</div><!--end #base-->

		<!-- END BASE -->

		<?php require 'inc/footer.php'; ?>
