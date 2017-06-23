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


	p._adminTable = function() {
    // var editTag = '<a href="edit.php?student_id">'
		var table = $('#adminTable').DataTable({
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
				{
					"class": 'delete-student',
					"orderable": false,
					"data": null,
					"defaultContent": '<button type="button" class="btn ink-reaction btn-raised btn-lg btn-danger" id="delete">Delete Student</button>'
				},


			],
			"tableTools": {
				"sSwfPath": $('#adminTable').data('swftools')
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

		$('#adminTable tbody').on('click', 'td.edit-student', function() {
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

		$('#adminTable tbody').on('click', 'td.delete-student', function() {

			alert('hello there');
		});
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

		$('#adminTable tbody').on('click', 'td.delete-student', function() {

			alert('hello there');
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
