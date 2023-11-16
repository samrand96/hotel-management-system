$(document).ready(function(){
    $('#datatable').DataTable();
    $('#datatable tbody').on( 'click', '.delete_btn', function () {
        var data = $('#datatable').DataTable().row( $(this).parents('tr') ).data();
        var id = data[0];
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#3085d6',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: modelName,
                    data: { action: "delete", id: id},
                    dataType: "JSON",
                    success: function (response) {
                        if(response.done == "0"){
                            update();
                            Swal.fire(
                                'Deleted!',
                                'Your data has been deleted.',
                                'success'
                            );
                        }else if(response.done == "-1"){
                            Swal.fire(
                                'Not Deleted!',
                                'You don\'t have permission to do this action.',
                                'warning'
                            );
                        }
                    }
                });
            }
        })
    } );

    $( "#add_btn" ).click(function() {
        let myForm = $('#add_form');
        let formData = new FormData(myForm[0]);
        $.ajax({
            type: "POST",
            url: modelName,
            data: formData,
            contentType : false,
            processData : false,
            dataType: "JSON",
            success: function (response) {
                if(response.done == "0"){
                    Swal.fire(
                        'Inserted!',
                        'Your data has been inserted.',
                        'success'
                    );
                    window.location.reload(1000);
                }else if(response.done == "-1"){
                    Swal.fire(
                        'Not Inserted!',
                        'You don\'t have permission to do this action.',
                        'warning'
                    );
                }
            }
        });
    });

    $( "#save_btn" ).click(function() {
        let myForm = $('#edit_form');
        let formData = new FormData(myForm[0]);
        $.ajax({
            type: "POST",
            url: modelName,
            data: formData,
            contentType : false,
            processData : false,
            dataType: "JSON",
            success: function (response) {
                if(response.done == "0"){
                    $("#edit_modal .close").click();
                    Swal.fire(
                        'Edited!',
                        'Your data has been edited.',
                        'success'
                    );
                    window.location.reload(1000);
                }else if(response.done == "-1"){
                    Swal.fire(
                        'Not Edited!',
                        'You don\'t have permission to do this action.',
                        'warning'
                    );
                }
            }
        });
    });

    function update(){
        window.location.reload();
    }
    
    $('.datepicker').datepicker();

});

function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
};
