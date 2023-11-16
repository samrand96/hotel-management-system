$(document).ready(function(){
	$('#datatable tbody').on( 'click', '.edit_btn', function () {
      var data = $('#datatable').DataTable().row( $(this).parents('tr') ).data();
      $('#id').val(data[0]);
      $('#name').val(data[1]);
      $('#remark').val(data[2]);
      $('#edit_modal').modal();
    });
});
