<!DOCTYPE html>

<html>
<head>
<title>Laravel7 CRUD @fahmidasclassroom.com</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
@yield('content')
</div>
</body>
<script>
$(document).ready(function () {

/* When click New type button */
$('#new-type').click(function () {
$('#btn-save').val("create-type");
$('#type').trigger("reset");
$('#typeCrudModal').html("Add New Type");
$('#crud-modal').modal('show');
});

/* Edit type */
$('body').on('click', '#edit-type', function () {
var type_id = $(this).data('id');
$.get('types/'+type_id+'/edit', function (data) {
$('#typeCrudModal').html("Edit type");
$('#btn-update').val("Update");
$('#btn-save').prop('disabled',false);
$('#crud-modal').modal('show');
$('#cust_id').val(data.id);
$('#name').val(data.name);
$('#price').val(data.price);
})
});
/* Show type */
$('body').on('click', '#show-type', function () {

var type_id = $(this).data('id');
console.log(type_id)
$('#nameshow').html(type_id['name']);
$('#priceshow').html(type_id['price']);
$('#typeCrudModal-show').html("Type Details");

$('#crud-modal-show').modal('show');
});

/* Delete type */
$('body').on('click', '#delete-type', function () {
var type_id = $(this).data("id");
var token = $("meta[name='csrf-token']").attr("content");
confirm("Are You sure want to delete !");

$.ajax({
type: "DELETE",
url: "http://localhost:8000/types/"+type_id,
//url: "http://localhost/laravel7crud/public/customers/"+customer_id,
data: {
"id": type_id,
"_token": token,
},
success: function (data) {
$('#msg').html('Type entry deleted successfully');
$("#type_id_" + type_id).remove();
},
error: function (data) {
console.log('Error:', data);
}
});
});
});

</script>
</html>