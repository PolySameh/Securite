<!DOCTYPE html>

<html>
<head>
<title></title>
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

/* When click New entraineur button */
$('#new-entraineur').click(function () {
$('#btn-save').val("create-entraineur");
$('#entraineur').trigger("reset");
$('#entraineurCrudModal').html("Add New Entraineur");
$('#crud-modal').modal('show');
});

/* Edit entraineur */
$('body').on('click', '#edit-entraineur', function () {
var entraineur_id = $(this).data('id');
$.get('entraineurs/'+entraineur_id+'/edit', function (data) {
$('#entraineurCrudModal').html("Edit entraineur");
$('#btn-update').val("Update");
$('#btn-save').prop('disabled',false);
$('#crud-modal').modal('show');
$('#cust_id').val(data.id);
$('#nom').val(data.nom);
$('#prenom').val(data.prenom);
$('#email').val(data.email);
//$('#type_id').val(data.type_id);

})

});
/* Show entraineur */
$('body').on('click', '#show-entraineur', function () {

var entraineur_id = $(this).data('id');
console.log(entraineur_id)
$('#nomshow').html(entraineur_id['nom']);
$('#prenomshow').html(entraineur_id['prenom']);
$('#emailshow').html(entraineur_id['email']);
$('#type_idshow').html(entraineur_id['type_id']);
$('#entraineurCrudModal-show').html("Entraineur Details");

$('#crud-modal-show').modal('show');
});

/* Delete entraineur */
$('body').on('click', '#delete-entraineur', function () {
var entraineur_id = $(this).data("id");
var token = $("meta[name='csrf-token']").attr("content");
confirm("Are You sure want to delete !");

$.ajax({
type: "DELETE",
url: "http://localhost:8000/entraineurs/"+entraineur_id,
//url: "http://localhost/laravel7crud/public/customers/"+customer_id,
data: {
"id": entraineur_id,
"_token": token,
},
success: function (data) {
$('#msg').html('Entraineur entry deleted successfully');
$("#entraineur_id_" + entraineur_id).remove();
},
error: function (data) {
console.log('Error:', data);
}
});
});
});

</script>
</html>