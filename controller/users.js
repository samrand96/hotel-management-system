$(document).ready(function(){
	$('#datatable tbody').on( 'click', '.change_password', function () {
      var data = $('#datatable').DataTable().row( $(this).parents('tr') ).data();
      $('#id').val(data[0]);
      $('#edit_modal').modal();
    });
});
