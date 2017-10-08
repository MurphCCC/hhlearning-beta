<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<!-- Present this form to the user for any course that is already existing -->
<form class="allforms" method="POST" action="">
    Grade<input type="text" name="grade" value="'.$c['grade'].'"></input>
    Course<input type="text" name="course_name" value="'.$c['course_name'].'"></input>
    Feedback<textarea name="feedback">'.$c['course_name'].'</textarea>
    <input type="hidden" name="student_id" value="1"></input>
    <input type="hidden" name="teacher_id" value="1">
    <input type="hidden" name="id" value="11"></input>
    <input type="hidden" name="update" value="true"></input>

  <input type="submit" />
</form>


<br />
<!-- Present this form to the user when they need to add a new course into the database -->

<form class="allforms" method="POST" action="">
    Grade<input type="text" name="grade" value="90"></input>
    Course<input type="text" name="course_name" value="Science"></input>
    Feedback<textarea name="feedback">jhakdfhka fhjka kflj dakjf as</textarea>
    <input type="hidden" name="student_id" value="1"></input>
    <input type="hidden" name="teacher_id" value="1">
    <input type="hidden" name="course_id" value=""></input>
    <input type="hidden" name="create" value="true"></input>


  <input type="submit" />
</form>

<br />
<button id="allsubmit" class="btn btn-info">Continue</button>

<script>
    $(function() {
    $("#allsubmit").click(function(){
        $('.allforms').each(function(){
            valuesToSend = $(this).serialize();
            alert($(this).serialize());
            $.ajax($(this).attr('action'),
                {
                method: $(this).attr('method'),
                data: valuesToSend,
                type: "POST",
                url: "testFormProcess.php"
                }
            )
        });
    });
});
</script>


<div class="row">
                                    <div class="col-lg-12">
                                        <h1 class="text-primary">'.$name.'</h1>
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
                                <div id="sections">
                                <div class="section">
                                    <div class="col-lg-offset-1 col-md-10 col-sm-6" >
                                        <div class="card">
                                            <div class="card-body">
                                                <form class="form" id="edit" action="">
                                                <div class="form-group">
                                                    <input type="hidden" name="teacher_id" class="form-control" id="teacher_id" value="'. $_SESSION['teacher_id'] .'">
                                                    <input type="hidden" name="student_id" class="form-control" id="student_id" value="'. $_REQUEST['student_id'] .'">
                                                    <input type="hidden" name="course_id[]" class="form-control" id="course_id" value="'.$c['id'].'">
                                                </div>
                                                    <div class="form-group">
                                                        <input type="text" name="cname[]'.$i.'" class="form-control" id="cname" value="'.$c['course_name'].'">
                                                        <label for="cname">Course Name</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="cgrade[]'.$i.'" class="form-control" id="cgrade" value="'.$c['grade'].'">
                                                        <label for="cgrade">Course Grade</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea name="feedback[]'.$i.'" rows="4" class="form-control" id="feedback" value="'.$c['feedback'].'">'.$c['feedback'].'</textarea>
                                                        <label for="feedback">Feedback</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-success" name="edit'.$c['id'].'" id="editCourse'.$c['id'].'"">Edit Course</button>
                                                </form>
                                            </div>
                                            </div><!--end .card-body -->
                                        </div><!--end .card -->
                                    </div><!--end .col -->
                                    <div class="col-lg-offset-1 col-md-6 col-sm-6" id="success"></div>
                                </div><!--end .row -->
                                </div>
                                </div>