<?php


require 'db-config.php';
//If we don't have a variable set, then make user a teacher by default.
include('functions.php');
// Get our teacher's information from the database, we will use this for all the students courses.
$sql = 'SELECT `username`, `first_name`, `last_name` FROM `teachers` WHERE `teacher_id` = :id';
$sql2 = 'SELECT DISTINCT `student_id` FROM `courses` WHERE `teacher_id` = :id';

$stmt = $db_con->prepare($sql);
$stmt->bindParam(':id', $_SESSION['teacher_id'], PDO::PARAM_INT);
$stmt->execute();
$t =  $stmt->fetchObject();

$stmt2 = $db_con->prepare($sql2);
$stmt2->bindParam(':id', $_SESSION['teacher_id'], PDO::PARAM_INT);
$stmt2->execute();
$students =  $stmt2->fetchAll(PDO::FETCH_ASSOC);


if (!isset($_SESSION['username'])) {
    header("location:login/main_login.php");
}
if ($_SESSION['admin_mode'] === 'teacher') {
	echo '<style>h3.teacher {
    display: none;
}</style>';
	
};


echo '
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Hilger Grading Admin</title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="your,keywords">
		<meta name="description" content="Short explanation about this website">
		<!-- END META -->

		<!-- BEGIN STYLESHEETS -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900" rel="stylesheet" type="text/css"/>
		<link type="text/css" rel="stylesheet" href="assets/css/theme-default/bootstrap.css?1422792965" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-default/materialadmin.css?1425466319" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-default/font-awesome.min.css?1422529194" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-default/material-design-iconic-font.min.css?1421434286" />
    <link type="text/css" rel="stylesheet" href="assets/css/theme-default/libs/DataTables/jquery.dataTables.css?1423553989" />
    <link type="text/css" rel="stylesheet" href="assets/css/theme-default/libs/DataTables/extensions/dataTables.colVis.css?1423553990" />
    <link type="text/css" rel="stylesheet" href="assets/css/theme-default/libs/DataTables/extensions/dataTables.tableTools.css?1423553990" />
		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
	</head>
	<body class="menubar-hoverable header-fixed menubar-pin ">

		<!-- BEGIN HEADER-->
		<header id="header" >
			<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">
						<li class="header-nav-brand" >
							<div class="brand-holder">
								<a href="#">
									<span class="text-lg text-bold text-primary">Hilger Grading Admin</span>
								</a>
							</div>
						</li>
						<li>
							<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
								<i class="fa fa-bars"></i>
							</a>
						</li>
					</ul>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="headerbar-right">
					<ul class="header-nav header-nav-profile">
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
								<img src="https://hhlearning.com/wp-content/uploads/2017/04/cropped-HH-Logo.png" alt="" />
								<span class="profile-info">
									'.$t->username.'
									<small>'.admin_mode().'</small>
								</span>
							</a>
							<!-- Configure options for teacher\'s drop down menu here.  Maybe add toggle adming mode link -->
							<ul class="dropdown-menu animation-dock">
								<li class="dropdown-header">Config</li>
								<li><a href="#" id="admin-toggle">Toggle Admin Mode</a></li>
								<li><a href="login/logout.php"><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
							</ul><!--end .dropdown-menu -->
						</li><!--end .dropdown -->
					</ul><!--end .header-nav-profile -->
					<ul class="header-nav header-nav-toggle">
						<li>
							<a class="btn btn-icon-toggle btn-default" href="#offcanvas-search" data-toggle="offcanvas" data-backdrop="false">
							<!--	<i class="fa fa-ellipsis-v"></i>	-->
							</a>
						</li>
					</ul><!--end .header-nav-toggle -->
				</div><!--end #header-navbar-collapse -->
			</div>
		</header>
    ';

    ?>
