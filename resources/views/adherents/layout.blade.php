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

/* When click New adherent button */
$('#new-adherent').click(function () {
$('#btn-save').val("create-adherent");
$('#adherent').trigger("reset");
$('#adherentCrudModal').html("Add New Adherent");
$('#crud-modal').modal('show');
});

/* Edit adherent */
$('body').on('click', '#edit-adherent', function () {
var adherent_id = $(this).data('id');
$.get('adherents/'+adherent_id+'/edit', function (data) {
$('#adherentCrudModal').html("Edit adherent");
$('#btn-update').val("Update");
$('#btn-save').prop('disabled',false);
$('#crud-modal').modal('show');
$('#cust_id').val(data.id);
$('#nom').val(data.nom);
$('#prenom').val(data.prenom);
$('#email').val(data.email);
$('#type').val(data.type);
})
});
/* Show adherent */
$('body').on('click', '#show-adherent', function () {

var adherent_id = $(this).data('id');
console.log(adherent_id)
$('#nomshow').html(adherent_id['nom']);
$('#prenomshow').html(adherent_id['prenom']);
$('#emailshow').html(adherent_id['email']);
$('#typeshow').html(adherent_id['type']);
$('#adherentCrudModal-show').html("Adherent Details");

$('#crud-modal-show').modal('show');
});

/* Delete adherent */
$('body').on('click', '#delete-adherent', function () {
var adherent_id = $(this).data("id");
var token = $("meta[name='csrf-token']").attr("content");
confirm("Are You sure want to delete !");

$.ajax({
type: "DELETE",
url: "http://localhost:8000/adherents/"+adherent_id,
//url: "http://localhost/laravel7crud/public/customers/"+customer_id,
data: {
"id": adherent_id,
"_token": token,
},
success: function (data) {
$('#msg').html('Adherent entry deleted successfully');
$("#adherent_id_" + adherent_id).remove();
},
error: function (data) {
console.log('Error:', data);
}
});
});
});

</script>
</html>