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
            <form class="form" action="" id="courseForm">
            <div class="form-group">
              <input type="hidden" name="teacher_id" class="form-control" id="teacher_id" value="'. $_SESSION['teacher_id'] .'">
              <input type="hidden" name="student_id" class="form-control" id="student_id" value="'. $_REQUEST['student_id'] .'">

            </div>
              <div class="form-group">
                <input type="text" name="cname" class="form-control" id="cname" value="">
                <label for="cname">Course Name</label>
              </div>
              <div class="form-group">
                <input type="text" name="cgrade" class="form-control" id="cgrade" value="">
                <label for="cgrade">Course Grade</label>
              </div>
              <div class="form-group">
                <textarea name="feedback" rows="4" class="form-control" id="feedback" value=""></textarea>
                <label for="feedback">Feedback</label>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-success" id="addCourse">Submit</button>
            </form>
          </div>
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
