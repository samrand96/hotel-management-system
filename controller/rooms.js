$(document).ready(function(){
	$('#datatable tbody').on( 'click', '.reserve_btn', function () {
      var data = $('#datatable').DataTable().row( $(this).parents('tr') ).data();
      id = data[0];
      $.ajax({
      	url: modelName,
      	type: 'POST',
      	dataType: 'json',
      	data: {action: 'reserve', id: id},
      })
      .done(function() {
      	window.location.reload();
      });
    });

    $('#datatable tbody').on( 'click', '.free_btn', function () {
      var data = $('#datatable').DataTable().row( $(this).parents('tr') ).data();
      id = data[0];
      $.ajax({
      	url: modelName,
      	type: 'POST',
      	dataType: 'json',
      	data: {action: 'free', id: id},
      })
      .done(function() {
      	window.location.reload();
      });
    });
});
