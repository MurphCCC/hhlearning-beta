<!-- This code demonstrates the ability to load a select box with values pulled from a JSON file.  It will be useful for further implementation of the administrator mode.  The idea is that an administrator will be able to change the teacher that is associated with a student/class. -->

<head>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</head>
<form action="#" method="GET">
	<select id="locality-dropdown" name="teacher_id"></select>
	<input type="submit" name="">

</form>


<script>
let dropdown = $('#locality-dropdown');

dropdown.empty();

dropdown.append('<option selected="true" disabled>Choose State/Province</option>');
dropdown.prop('selectedIndex', 0);

const url = '../assets/teachers.json';

// Populate dropdown with list of provinces
$.getJSON(url, function (data) {
  $.each(data, function (key, entry) {
    dropdown.append($('<option></option>').attr('value', entry.teacher_id).text(entry.first_name));
  })
});
</script>

