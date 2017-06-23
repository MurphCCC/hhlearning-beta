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

						<!-- BEGIN TABLE OF STUDENTS -->
						<div class="row">
							<div class="col-md-12">
							</div><!--end .col -->
							<div class="col-lg-12">
								<div class="table-responsive">
									<?php
									if($mode === 'teacher') {
										echo '
												<table id="teacherTable" class="table order-column hover" data-source="assets/students.json" data-swftools="assets/js/libs/DataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf">
										';
									} elseif ($mode === 'admin') {
										echo '
												<table id="adminTable" class="table order-column hover" data-source="assets/students.json" data-swftools="assets/js/libs/DataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf">
										';
									}
									 ?>
									<!-- <table id="datatable2" class="table order-column hover" data-source="assets/students.json" data-swftools="assets/js/libs/DataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"> -->
										<thead>
											<tr>
												<th>First Name</th>
												<th>Last Name</th>
												<th>Actions</th>
												<th></th>
											</tr>
										</thead>
									</table>
								</div><!--end .table-responsive -->
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END TABLE OF STUDENTS -->

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

<?php require 'inc/footer.php'; ?>
