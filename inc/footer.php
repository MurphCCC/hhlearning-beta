<!-- BEGIN JAVASCRIPT -->
<script src="assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
<script src="assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="assets/js/libs/bootstrap/bootstrap.min.js"></script>
<script src="assets/js/libs/spin.js/spin.min.js"></script>
<script src="assets/js/libs/autosize/jquery.autosize.min.js"></script>
<script src="assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
<script src="assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
<script src="assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
<script src="assets/js/core/source/App.js"></script>
<script src="assets/js/core/source/AppNavigation.js"></script>
<script src="assets/js/core/source/AppOffcanvas.js"></script>
<script src="assets/js/core/source/AppCard.js"></script>
<script src="assets/js/core/source/AppForm.js"></script>
<script src="assets/js/core/source/AppNavSearch.js"></script>
<script src="assets/js/core/source/AppVendor.js"></script>
<script src="assets/js/core/demo/Demo.js"></script>
<script src="assets/js/studentsTable.js"></script>


<script>
    $('#admin-toggle').click(function(){
      request = $.ajax({
      url: "inc/functions.php?toggleAdminMode=true",
      type: "POST",
  });

  // callback handler that will be called on success
  request.done(function (response, textStatus, jqXHR){
      // log a message to the console
      location.reload();
  });

  // callback handler that will be called on failure
  request.fail(function (jqXHR, textStatus, errorThrown){
      // log the error to the console
      console.error(
          "The following error occured: "+
          textStatus, errorThrown
      );
      });
  });


</script>

<script>
//define template
//This script is what gets executed when trying to add another course to the page.  We need to figure out a way to automate
//this but also to increment the id of the form.  Basically, I need a way to be able to add forms to the page dynamically and process
//them all individually.
var template = $('#sections .section:first').clone();

var student_id = "<?php echo $c['id'];?>";

//define counter
var sectionsCount = 1;

//add new section
$('body').on('click', '.addsection', function() {
    //increment
    sectionsCount++;

    //loop through each input
    var section = template.clone().find(':input').each(function(){

        //set id to store the updated section number
        var newId = this.id + sectionsCount;

        //update for label
        // $(this).prev().attr("value", );

        //update name and id

          this.name = newId;
          this.id = newId;
          var test = $("input[name=student_id2]:hidden");
          test.val('work!');
          // $("#student_id2").val(2);



        //Clear out each input value so that our cloned form is blank
        $(this).attr('value', '');
    }).end()

    //inject new section
    .appendTo('#sections');
    return false;
    document.getElementById("#edit").reset();
});

//remove section
$('#sections').on('click', '.remove', function() {
    //fade out section
    $(this).parent().fadeOut(300, function(){
        //remove parent element (main section)
        $(this).parent().parent().empty();
        return false;
    });
    return false;
});
//AddCourse function
$(document).ready(function() {
    var teacher_id = <?php echo $_SESSION['teacher_id']; ?>;
    var student_id = '<?php echo $_REQUEST['student_id']; ?>';
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    // $(add_button).click(function(e){ //on add input button click
    //     e.preventDefault();
    //     if(x < max_fields){ //max input box allowed
    //         x++; //text box increment
    //         $('.start-course').clone().insertAfter(".start-course");
    //
    //     }
    //
    // });
    //
    // $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    //     e.preventDefault(); $(this).parent('div').remove(); x--;
    // })


});


// Auto Capitalize our form data
$('input').keyup(function() {
        this.value = this.value.charAt(0).toUpperCase()+this.value.slice(1);
    });
// Submit our form for processing
// $("#addBlankCourse").on('click', function() {
//   var courses = [1, + i];
//   i = 1;
//
//
//   c = courses[courses.length - 1];
//   x = '<?php echo $_GET['student_id'] ?>';
//
//     function nextClass() {
//       if (i >= 14) {
//         console.log('you have reached the limit');
//       return;
//       } else {
//         if (courses.includes(i)) {
//         courses.push(++i);
//         console.log('i++ pushed by if statement');
//         console.log(courses);
//         // document.getElementById("classes").innerHTML = 'The next available class is ' + courses[courses.length - 1];
//       } else {
//         courses.push(i);
//         console.log('i pushed by else statement');
//       }
//       }
//         xhttp.open("POST", "inc/addCourse.php?addCourse=true&i=" + courses[courses.length - 1] + "&student_id=" + student_id, false);
//         xhttp.send();
//         if (!xhttp.responseText) {
//           alert('empty response');
//         }
//         alert('Course number' + courses[courses.length - 1]);
//        courses.push(++i);
//        console.log('I pushed at end of script');
//     }
//
// });
//
//  </script>
//  <script>
// student_id = <?php echo $_REQUEST['student_id']; ?>;
// i = 1;
// // $("#addBlankCourse").on('click', function() {
// //   $.ajax({
// //     type: "POST",
// //     url: "inc/addCourse.php",
// //     data: "addCourse=true&student_id=" + student_id + "&i=" + i,
// //     success: function(result) {
// //       $('#courses').html(result).fadeIn(5000);
// //       console.log(result);
// //     }
// //   })
// // })
$("#addStudentSubmit").on('click', function() {
  var datastring = $("#add").serialize();
  function addStudent() {
    return $.ajax({
        type: "POST",
        url: "inc/processForm.php?action=add&",
        data: datastring,
        success: function(data) {
          var card = '<div class="card" id="successCard"><div class="card-body" id="success"><h1><center>'+data+'</center></h1></div></div>';
          $("#success").html(card).fadeIn(5000);
          $("#success").delay(5000).fadeOut("slow");
          $("#add")[0].reset();
          alert('hello');
        },
        error: function() {
            alert('Sorry something went wrong');
        }
    });
  }

  function updateStudents() {
    $.ajax({
        type: "POST",
        url: "inc/listStudents.php",
        data: datastring,
        success: function(data) {
          return $.when();
        },
        error: function() {
            alert('Sorry something went wrong');
        }
    });
  }

  addStudent().then(updateStudents);

})


</script>

<script>

// Auto Capitalize our form data
$('input').keyup(function() {
        this.value = this.value.charAt(0).toUpperCase()+this.value.slice(1);
    });
// Submit our form for processing

$("#editCourse").on('click', function() {
  str = $("form").serialize();
  alert(str);
  $.ajax({
      type: "POST",
      url: "inc/processForm.php?action=editCourse&",
      data: str,
      success: function(data) {
        var card = '<div class="card" id="successCard"><div class="card-body" id="success"><h1><center>'+data+'</center></h1></div></div>';
        $("#success").html(card).fadeIn(5000);
        $("#success").delay(5000).fadeOut("slow");
        $("#addCourse")[0].reset();
      },
      error: function() {
          alert('Sorry something went wrong');
      }
  });
  console.log(str);
})



$("#editCourse1").on('click', function() {
  str = $("#edit1").serialize();
  $.ajax({
      type: "POST",
      url: "inc/processForm.php?action=editCourse&",
      data: str,
      success: function(data) {
        var card = '<div class="card" id="successCard"><div class="card-body" id="success"><h1><center>'+data+'</center></h1></div></div>';
        $("#success").html(card).fadeIn(5000);
        $("#success").delay(5000).fadeOut("slow");
        $("#addCourse")[0].reset();
      },
      error: function() {
          alert('Sorry something went wrong');
      }
  });
  console.log(str);
})
$("#addCourse").on('click', function() {
  var datastring = $("#courseForm").serialize();
  function addCourse() {
    return $.ajax({
        type: "POST",
        url: "inc/processForm.php?action=addCourse&",
        data: datastring,
        success: function(data) {
          var card = '<div class="card" id="successCard"><div class="card-body" id="success"><h1><center>'+data+'</center></h1></div></div>';
          $("#success").html(card).fadeIn(5000);
          $("#success").delay(5000).fadeOut("slow");
          $("#courseForm")[0].reset();
        },
        error: function() {
            alert('Sorry something went wrong');
        }
    });
  }


  function updateStudents() {
    $.ajax({
        type: "POST",
        url: "inc/listStudents.php",
        data: datastring,
        success: function(data) {
          return $.when();
        },
        error: function() {
            alert('Sorry something went wrong');
        }
    });
  }

  addCourse().then(updateStudents);

})


</script>
</body>
</html>
