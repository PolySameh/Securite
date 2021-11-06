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

/* When click New coach button */
$('#new-coach').click(function () {
$('#btn-save').val("create-coach");
$('#coach').trigger("reset");
$('#coachCrudModal').html("Add New Coach");
$('#crud-modal').modal('show');
});

/* Edit coach */
$('body').on('click', '#edit-coach', function () {
var coach_id = $(this).data('id');
$.get('coachs/'+coach_id+'/edit', function (data) {
$('#coachCrudModal').html("Edit coach");
$('#btn-update').val("Update");
$('#btn-save').prop('disabled',false);
$('#crud-modal').modal('show');
$('#cust_id').val(data.id);
$('#nom').val(data.nom);
$('#prenom').val(data.prenom);
$('#email').val(data.email);
})
});
/* Show coach */
$('body').on('click', '#show-coach', function () {

var coach_id = $(this).data('id');
console.log(coach_id)
$('#nomshow').html(coach_id['nom']);
$('#prenomshow').html(coach_id['prenom']);
$('#emailshow').html(coach_id['email']);

$('#coachCrudModal-show').html("Coach Details");
$('#crud-modal-show').modal('show');
});

/* Delete coach */
$('body').on('click', '#delete-coach', function () {
var coach_id = $(this).data("id");
var token = $("meta[name='csrf-token']").attr("content");
confirm("Are You sure want to delete !");

$.ajax({
coach: "DELETE",
url: "http://localhost:8000/coachs/"+coach_id,
//url: "http://localhost/laravel7crud/public/customers/"+customer_id,
data: {
"id": coach_id,
"_token": token,
},
success: function (data) {
$('#msg').html('Coach entry deleted successfully');
$("#coach_id_" + coach_id).remove();
},
error: function (data) {
console.log('Error:', data);
}
});
});
});

</script>
</html>