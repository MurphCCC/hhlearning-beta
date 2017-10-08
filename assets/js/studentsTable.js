(function(namespace, $) {
	"use strict";

	var DemoTableDynamic = function() {
		// Create reference to this instance
		var o = this;
		// Initialize app when document is ready
		$(document).ready(function() {
			o.initialize();
		});

	};
	var p = DemoTableDynamic.prototype;

	// =========================================================================
	// INIT
	// =========================================================================

	p.initialize = function() {
		this._initDataTables();
	};

	// =========================================================================
	// DATATABLES
	// =========================================================================

	p._initDataTables = function() {
		if (!$.isFunction($.fn.dataTable)) {
			return;
		}

		// Init the demo DataTables
		this._teacherTable();
		this._adminTable();
	};

	p._teacherTable = function() {
		// var editTag = '<a href="edit.php?student_id">'
		var table = $('#teacherTable').DataTable({
			"dom": 'T<"clear">lfrtip',
			"ajax": 'assets/students.json',
			"columns": [
				{"data": "first_name"},
				{"data": "last_name"},
				{
					"class": 'edit-student',
					"orderable": false,
					"data": null,
					"defaultContent": '<button type="button" class="btn ink-reaction btn-raised btn-lg btn-primary" id="edit">Edit Student</button>'
				},
			],
			"tableTools": {
				"sSwfPath": $('#teacherTable').data('swftools')
			},
			"order": [[1, 'asc']],
			"language": {
				"lengthMenu": '_MENU_ students per page',
				"search": '<i class="fa fa-search"></i>',
				"paginate": {
					"previous": '<i class="fa fa-angle-left"></i>',
					"next": '<i class="fa fa-angle-right"></i>'
				}
			}
		});

		//Add event listener for opening and closing details
		var o = this;

		$('#teacherTable tbody').on('click', 'td.edit-student', function() {
			var tr = $(this).closest('tr');
			var row = table.row(tr);

			if (row.child.isShown()) {
				// This row is already open - close it
				row.child.hide();
				tr.removeClass('shown');
			}
			else {
				// Open this row
				row.child(o._formatDetails(row.data())).show();
				tr.addClass('shown');
			}
		});

			$('#adminTable tbody').on('click', 'td.deleteStudent', function() {
				alert('You clicked delete');
		});
	};


	p._adminTable = function() {


		var table = $('#adminTable').DataTable({
			"dom": 'T<"clear">lfrtip',
			"ajax": 'assets/students.json',
			"aoColumns": [
					{
						"mData":"first_name",
						"sTitle": "First Name"
					},{
						"mData": "last_name", //mData must correspond to a key/value in our students.json file.
						"sTitle": "Last Name" //sTitle is the name we wish to give to our column in the table
					},{
						"mData": "student_id",
						"className": "deleteStudent",
						"mRender": function ( url, type, full )  {  // In this case url is simple a placeholder for the student id that is being pulled from the JSON file.
							var student_id = url;
							// return '<a id="deleteStudent" href="inc/processForm.php?action=deleteStudent&student_id='+url+'">Delete Student</a>';
							return '<a data-hidden="'+url+'" class="deleteLink" id="delete" value="'+url+'">Delete</a>';
						}
					},
				],
			"tableTools": {
				"sSwfPath": $('#teacherTable').data('swftools')
			},
			"order": [[1, 'asc']],
			"language": {
				"lengthMenu": '_MENU_ students per page',
				"search": '<i class="fa fa-search"></i>',
				"paginate": {
					"previous": '<i class="fa fa-angle-left"></i>',
					"next": '<i class="fa fa-angle-right"></i>'
				}
			}
		});

		//Add event listener for opening and closing details
		var o = this;

		function test(url) {
			alert('hello',url);
		}

				//Listen confirm deletion of student then send post to form processing
				$('#adminTable tbody').on('click', '.deleteLink', function() {

					var student_id = $(this).data('hidden');
					
					if (confirm("Are you sure you want to delete this student?") == true) {
					        $.ajax({
						        type: "POST",
						        url: "inc/processForm.php?action=deleteStudent&student_id=" + student_id,
						        success: function(data) {

						 		    var sucMesg = function(data) {
						 		    	alert(data);
						 		    	location.reload();
						 		    }
						          return sucMesg(data);

						        },
						        error: function(data) {
						            alert('Sorry something went wrong');
						        }
						    });
					} else {
					    txt = "No changes have been made";
					}
				
		});




	};
	// =========================================================================
	// DETAILS
	// =========================================================================

	p._formatDetails = function(d) {
		// `d` is the original data object for the row
    window.location.assign('editStudent.php?student_id='+d.student_id);
		// return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
		// 		'<tr>' +
		// 		'<td>Full name:</td>' +
		// 		'<td>' + d.student_id + '</td>' +
		// 		'</tr>' +
		// 		'<tr>' +
		// 		'<td>Extension number:</td>' +
		// 		'<td>' + d.extn + '</td>' +
		// 		'</tr>' +
		// 		'<tr>' +
		// 		'<td>Extra info:</td>' +
		// 		'<td>And any further details here (images etc)...</td>' +
		// 		'</tr>' +
		// 		'</table>';
	};



	// =========================================================================
	namespace.DemoTableDynamic = new DemoTableDynamic;
}(this.materialadmin, jQuery)); // pass in (namespace, jQuery):


$('#adminTable tbody').on('click', 'td.deleteStudent', function () {
	confirm("Delete Student?");
    } );
