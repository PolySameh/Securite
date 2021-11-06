@include('layouts.app')

@extends('types.layout')
@section('content')
	<div class="container">
		@include('layouts.navbar')       
	</div>

	<div class="row">
		<div class="col-lg-12" style="text-align: center">
			<div >
				<h2>CRUD </h2>
			</div>
			<br/>
		</div>
	</div>
	<div class="row">
	<div class="col-lg-12 margin-tb">
	<div class="pull-right">
	<a href="javascript:void(0)" class="btn btn-success mb-2" id="new-type" data-toggle="modal">New Type</a>
	</div>
	</div>
	</div>
	<br/>
	@if ($message = Session::get('success'))
	<div class="alert alert-success">
	<p id="msg">{{ $message }}</p>
	</div>
	@endif
	<table class="table table-bordered">
	<tr>
	<th>ID</th>
	<th>Name</th>
	<th>price</th>
	<th width="280px">Action</th>
	</tr>

	@foreach ($types as $type)
	<tr id="type_id_{{ $type->id }}">
	<td>{{ $type->id }}</td>
	<td>{{ $type->name }}</td>
	<td>{{ $type->price }}</td>
	<td> 
	<form action="{{ route('types.destroy',$type->id) }}" method="POST">
	<a class="btn btn-info" id="show-type" data-toggle="modal" data-id="{{ $type}}" >Show</a>
	<a href="javascript:void(0)" class="btn btn-success" id="edit-type" data-toggle="modal" data-id="{{ $type->id }}">Edit </a>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<a id="delete-type" data-id="{{ $type->id }}" class="btn btn-danger delete-user">Delete</a></td>
	</form>
	</td>
	</tr>
	@endforeach

	</table>
	{!! $types->links() !!}
	<!-- Add and Edit type modal -->
	<div class="modal fade" id="crud-modal" aria-hidden="true" >
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	<h4 class="modal-title" id="typeCrudModal"></h4>
	</div>
	<div class="modal-body">
	<form name="custForm" action="{{ route('types.index') }}" method="POST">
	<input type="hidden" name="cust_id" id="cust_id" >
	@csrf
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
	<div class="form-group">
	<strong>Name:</strong>
	<input type="text" name="name" id="name" class="form-control" placeholder="Name" onchange="validate()" >
	</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
	<div class="form-group">
	<strong>Price:</strong>
	<input type="text" name="price" id="price" class="form-control" placeholder="Price" onchange="validate()">
	</div>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 text-center">
	<button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disbaled >Submit</button>
	<a href="{{ route('types.index') }}" class="btn btn-danger">Cancel</a>
	</div>
	</div>
	</form>
	</div>
	</div>
	</div>
	</div>
	<!-- Show type modal -->
	<div class="modal fade" id="crud-modal-show" aria-hidden="true" >
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	<h4 class="modal-title" id="typeCrudModal-show"></h4>
	</div>
	<div class="modal-body">
	<div class="row">
	<div class="col-xs-2 col-sm-2 col-md-2"></div>
	<div class="col-xs-10 col-sm-10 col-md-10 ">
	@if(isset($type->name))

	<table>
	<tr><td><strong>Name:</strong></td><td id="nameshow">{{$type->name}}</td></tr>
	<tr><td><strong>Price:</strong></td><td id="priceshow">{{$type->price}}</td></tr>
	<tr><td colspan="2" style="text-align: right "><a href="{{ route('types.index') }}" class="btn btn-danger">OK</a> </td></tr>
	</table>
	@endif
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
@endsection
<script>
error=false

function validate()
{
	if(document.custForm.name.value !='' && document.custForm.price.value !='')
	    document.custForm.btnsave.disabled=false
	else
		document.custForm.btnsave.disabled=true
}
</script>