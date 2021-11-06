

@include('layouts.app')

@extends('entraineurs.layout')
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
<a href="javascript:void(0)" class="btn btn-success mb-2" id="new-entraineur" data-toggle="modal">New Entraineur</a>
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
<th>Nom</th>
<th>Prenom</th>
<th>Email</th>
<th>Type</th>
<th width="280px">Action</th>
</tr>

@foreach ($entraineurs as $entraineur)
<tr id="entraineur_id_{{ $entraineur->id }}">
<td>{{ $entraineur->id }}</td>
<td>{{ $entraineur->nom }}</td>
<td>{{ $entraineur->prenom }}</td>
<td>{{ $entraineur->email }}</td>
<td>{{ $entraineur->type->name }}</td>
<td> 
<form action="{{ route('entraineurs.destroy',$entraineur->id) }}" method="POST">
<a class="btn btn-info" id="show-entraineur" data-toggle="modal" data-id="{{ $entraineur}}" >Show</a>
<a href="javascript:void(0)" class="btn btn-success" id="edit-entraineur" data-toggle="modal" data-id="{{ $entraineur->id }}">Edit </a>
<meta name="csrf-token" content="{{ csrf_token() }}">
<a id="delete-entraineur" data-id="{{ $entraineur->id }}" class="btn btn-danger delete-user">Delete</a></td>
</form>
</td>
</tr>
@endforeach

</table>
{!! $entraineurs->links() !!}
<!-- Add and Edit entraineur modal -->
<div class="modal fade" id="crud-modal" aria-hidden="true" >
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="entraineurCrudModal"></h4>
</div>
<div class="modal-body">
<form name="custForm" action="{{ route('entraineurs.index') }}" method="POST">
<input type="hidden" name="cust_id" id="cust_id" >
@csrf
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Nom:</strong>
<input type="text" name="nom" id="name" class="form-control" placeholder="Nom" onchange="validate()" >
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Prenom:</strong>
<input type="text" name="prenom" id="price" class="form-control" placeholder="Prenom" onchange="validate()">
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Email:</strong>
<input type="text" name="email" id="email" class="form-control" placeholder="Email" onchange="validate()">
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">

<div class="form-group">
	<strong>Type</strong>
	
	<select name="type_id" id="myselect">
	@foreach ($types as $type)
  <option value='{{$type->id}}'>{{$type->name}}</option>
   @endforeach
</select>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 text-center">
<button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disbaled >Submit</button>
<a href="{{ route('entraineurs.index') }}" class="btn btn-danger">Cancel</a>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<!-- Show entraineur modal -->
<div class="modal fade" id="crud-modal-show" aria-hidden="true" >
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="entraineurCrudModal-show"></h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-xs-2 col-sm-2 col-md-2"></div>
<div class="col-xs-10 col-sm-10 col-md-10 ">
@if(isset($entraineur->nom))

<table>
<tr><td><strong>Nom:</strong></td><td id="nomshow">{{$entraineur->nom}}</td></tr>
<tr><td><strong>Prenom:</strong></td><td id="prenomshow">{{$entraineur->prenom}}</td></tr>
<tr><td><strong>Email:</strong></td><td id="emailshow">{{$entraineur->email}}</td></tr>
<tr><td><strong>Type_id:</strong></td><td id="type_idshow">{{$entraineur->type_id}}</td></tr>
<tr><td colspan="2" style="text-align: right "><a href="{{ route('entraineurs.index') }}" class="btn btn-danger">OK</a> </td></tr>
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
	if(document.custForm.nom.value !='' && document.custForm.prenom.value !=''&& document.custForm.email.value !='')
	    document.custForm.btnsave.disabled=false
	else
		document.custForm.btnsave.disabled=true
}
</script>