<?php
require 'inc/header.php';
?>

		<!-- END HEADER-->

		<!-- BEGIN BASE-->
		<div id="base">
			<!-- WE NEED THIS BLOCK IN ORDER FOR OUR OFFCANVAS ELEMENT LATER IN THE PAGE TO WORK -->
			<div class="offcanvas"></div>
			<!-- BEGIN CONTENT-->
			<div id="content">

				<!-- BEGIN BLANK SECTION -->
				<section>
					<div class="section-header">
						<ol class="breadcrumb">
							<li><a href="#">Home</a></li>
							<li class="active">All Students</li>
						</ol>
					</div><!--end .section-header -->
					<div class="section-body">

            <!-- BEGIN INTRO -->
						<div class="row">
							<div class="col-lg-12">
								<h1 class="text-primary">Add a student</h1>
							</div><!--end .col -->
							<div class="col-lg-8">
								<article class="margin-bottom-xxl">
									<p class="lead">
										Enter students first and last name and click 'Submit'
									</p>
								</article>
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END INTRO -->

						<!-- BEGIN BASIC ELEMENTS -->
            <div class="row">
							<div class="col-lg-offset-1 col-md-4 col-sm-6">
								<div class="card">
									<div class="card-body">
										<form class="form" id="add" action="">
											<div class="form-group">
												<input type="text" name="fname" class="form-control" id="fname" value="">
												<label for="fname">First Name</label>
											</div>
											<div class="form-group">
												<input type="text" name="lname" class="form-control" id="lname" value="">
												<label for="lname">Last Name</label>
											</div>
                      <div class="form-group">
                        <button type="button" class="btn btn-success" id="addStudentSubmit">Submit</button>
										</form>
                  </div>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
              <div class="col-lg-offset-1 col-md-6 col-sm-6" id="success"></div>

						</div><!--end .row -->
						<!-- END BASIC ELEMENTS -->


					</div><!--end .section-body -->
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
										<img src="assets/img/avatar4.jpg?1404026791" alt="" />
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

		<script src="assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
		<script src="assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
		<script>




		$("#addStudentSubmit").on('click', function() {
		  var datastring = $("#add").serialize();
		  function addStudent() {
		    return $.ajax({
		        type: "POST",
		        url: "inc/processForm.php",
		        data: 'action=add&' + datastring,
		        success: function(data) {
		          var card = '<div class="card" id="successCard"><div class="card-body" id="success"><h1><center>'+data+'</center></h1></div></div>';
		          $("#success").html(card).fadeIn(5000);
		          $("#success").delay(5000).fadeOut("slow");
		          $("#add")[0].reset();
		        },
		        error: function() {
		            alert('Sorry something went wrong');
		        }
		    });
		  }
			addStudent();
			$.post('inc/listStudents.php');
		});

			</script>
    <?php //require 'inc/footer.php'; ?>
