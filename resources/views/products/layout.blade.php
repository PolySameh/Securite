<!DOCTYPE html>

<html>
<head>
<title>CRUD </title>
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

/* When click New product button */
$('#new-product').click(function () {
$('#btn-save').val("create-product");
$('#product').trigger("reset");
$('#productCrudModal').html("Add New Product");
$('#crud-modal').modal('show');
});

/* Edit product */
$('body').on('click', '#edit-product', function () {
var product_id = $(this).data('id');
$.get('products/'+product_id+'/edit', function (data) {
$('#productCrudModal').html("Edit product");
$('#btn-update').val("Update");
$('#btn-save').prop('disabled',false);
$('#crud-modal').modal('show');
$('#cust_id').val(data.id);
$('#name').val(data.name);
$('#price').val(data.price);
$('#amount').val(data.amount);
})
});
/* Show product */
$('body').on('click', '#show-product', function () {

var product_id = $(this).data('id');
console.log(product_id)
$('#nameshow').html(product_id['name']);
$('#priceshow').html( product_id['price']);
$('#amountshow').html( product_id['amount']);
$('#productCrudModal-show').html("Product Details");

$('#crud-modal-show').modal('show');
});

/* Delete product */
$('body').on('click', '#delete-product', function () {
var product_id = $(this).data("id");
var token = $("meta[name='csrf-token']").attr("content");
confirm("Are You sure want to delete !");

$.ajax({
type: "DELETE",
url: "http://localhost:8000/products/"+product_id,
//url: "http://localhost/laravel7crud/public/customers/"+customer_id,
data: {
"id": product_id,
"_token": token,
},
success: function (data) {
$('#msg').html('Product entry deleted successfully');
$("#product_id_" + product_id).remove();
},
error: function (data) {
console.log('Error:', data);
}
});
});
});

</script>
</html>