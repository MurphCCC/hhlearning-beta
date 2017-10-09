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
	foreach ($s as $student) {
		echo $student->first_name;
	}
?>

<div id="base">
	<div class="offcanvas"></div>
		<section>
			<div class="section-header">
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">All Students</li>
				</ol>
			</div><!--end .section-header -->
			
			<div class="section-body">
				<!-- Controls for our form submission/creation -->
					<div class="controls">
					<button type="button" class="btn btn-info addsection">Add a blank course</button>
					<button id="allsubmit" class="btn btn-success">Save</button>
					Enter 
							<?php 	
								foreach ($s as $student) {
									$first = $student['first_name'];
									$last = $student['last_name'];
								}; ?> 
								<?php echo $first . ' ' . $last; ?> 's information below and click Save
					<article class="margin-bottom-xxl">
				</div>
				
						<!-- <p class="lead"> --></p>
						

				</article>

				
				<?php  
				//sizeof($courses) should return then number of courses a student has been assigned.  If this number is 0, then we want to display a form, and when the teacher submits it, it should create the first course for this student/teacher combo, else we should have an edit button for each entry.
					if(sizeof($courses) === 0) {
					    addCourse();
					} else {
						$i = 0;
						foreach ($courses as $c) {
							echo '
								<div class="row">
									<div id="sections" class="section">
										<div class="col-lg-offset-1 col-md-10 col-sm-6" >
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<form class="allforms" method="POST" action="">
											    			Grade<input class="form-control" type="text" name="grade" value="'.$c["grade"].'"></input>
											    			Course<input class="form-control" type="text" name="course_name" value="'.$c["course_name"].'"></input>
											    			Feedback<textarea class="form-control" name="feedback">'.$c["feedback"].'</textarea>
											        		<input type="hidden" name="id" value="'.$c["id"].'"></input>
												    		<input type="hidden" name="update" value="true"></input>

														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
										<div class="col-lg-offset-1 col-md-6 col-sm-6" id="success"></div>
								</div><!--end .row -->
								';
								$i++;
							}
						}
				?>
			</div>
				<div class="newSection"></div>
		</section>
	</div>
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

		<script>
$("#Save").on("click",function() {
    $(".MCQuestion").each(function(){
        if($(this).val()!=""){
            $(this).closest(".formRow").find(".MCAnswer").each(function(){
                $('#log').after($(this).val());
            });
        }
    });
    return false;
});
</script>