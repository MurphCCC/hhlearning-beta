<?php
session_start();

$mode = $_SESSION['admin_mode'];

function toggle() {
  if ($_SESSION['admin_mode'] === 'admin') {
    $_SESSION['admin_mode'] = 'teacher';
  } else {
    $_SESSION['admin_mode'] = 'admin';
  }
}
if (isset($_REQUEST['toggleAdminMode'])) {
  toggle();
}

  function admin_mode() {
  	global $mode;
  	if (isset($mode) && $mode === 'admin') {
  		return 'Administrator';
  	} elseif (isset($mode) && $mode === 'teacher') {
  		return 'Teacher';
  	}
  }


  function addCourse() {
    echo '

    <!-- BEGIN INTRO -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="text-primary">Add a Course</h1>
      </div><!--end .col -->
      <div class="col-lg-8">
        <article class="margin-bottom-xxl">
          <p class="lead">
            Enter students first and last name and click \'Submit\'
          </p>
        </article>
      </div><!--end .col -->
    </div><!--end .row -->
    <!-- END INTRO -->

    <!-- BEGIN BASIC ELEMENTS -->
    <div class="row">
      <div class="col-lg-offset-1 col-md-10 col-sm-6">
        <div class="card">
          <div class="card-body">
            
          <form class="allforms" method="POST" action="">
    Grade<input class="form-control" type="text" name="grade" value="90"></input>
    Course<input class="form-control" type="text" name="course_name" value="Science"></input>
    Feedback<textarea class="form-control" name="feedback">jhakdfhka fhjka kflj dakjf as</textarea>
    <input type="hidden" name="student_id" value="'. $_REQUEST['student_id'] .'"></input>
    <input type="hidden" name="teacher_id" value="'. $_SESSION['teacher_id'] .'">
    <input type="hidden" name="create" value="true"></input>


  <input type="submit" />
</form>
          </div><!--end .card-body -->
        </div><!--end .card -->
      </div><!--end .col -->
      <div class="col-lg-offset-1 col-md-6 col-sm-6" id="success"></div>

    </div><!--end .row -->
    <!-- END BASIC ELEMENTS -->


  </div><!--end .section-body -->


    ';
  }



 ?>
