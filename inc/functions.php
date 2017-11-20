<?php
session_start();

$mode = $_SESSION['admin_mode'];
$is_admin = $_SESSION['is_admin'];

if (!isset($_SESSION['admin_mode'])) {
  $_SESSION['admin_mode'] = 'teacher';
  
}

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
    if(isset($mode)) {
        if (isset($mode) && $mode === 'admin') {
      return 'Administrator Mode';
    } elseif (isset($mode) && $mode === 'teacher') {
      return 'Teacher Mode';
    } 
    }
    else {
      return 'Teacher Mode';
    }

  }


  function addCourse() {
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
                                <input type="hidden" name="student_id" value="'. $_REQUEST['student_id'] .'"></input>
                                <input type="hidden" name="teacher_id" value="'. $_SESSION['teacher_id'] .'">
                                <input type="hidden" name="create" value="true"></input>

                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                    <div class="col-lg-offset-1 col-md-6 col-sm-6" id="success"></div>
                </div><!--end .row -->

    ';
  }



 ?>
