<?php
include('functions.php');

if(isset($_POST['addCourse']) && $_POST['addCourse'] === 'true') {
$i = $_POST['i'];
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
    Grade<input class="form-control" type="text" name="grade" value=""></input>
    Course<input class="form-control" type="text" name="course_name" value=""></input>
    Feedback<textarea class="form-control" name="feedback"></textarea>
    <input type="hidden" name="student_id" value="'.$c["student_id"].'"></input>
    <input type="hidden" name="teacher_id" value="'.$c["teacher_id"].'">
    <input type="hidden" name="course_id" value=""></input>
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

} else {

}

 ?>
