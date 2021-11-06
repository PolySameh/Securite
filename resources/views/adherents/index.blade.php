@include('layouts.app')

@extends('adherents.layout')
@section('content')
<div class="container">
@include('layouts.navbar')
                

                
          
</div>

<div class="row">
<div class="col-lg-12" style="text-align: center">
<div >
<h2> CRUD</h2>
</div>
<br/>
</div>
</div>
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-right">
<a href="javascript:void(0)" class="btn btn-success mb-2" id="new-adherent" data-toggle="modal">New Adherent</a>
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

@foreach ($adherents as $adherent)
<tr id="adherent_id_{{ $adherent->id }}">
<td>{{ $adherent->id }}</td>
<td>{{ $adherent->nom }}</td>
<td>{{ $adherent->prenom }}</td>
<td>{{ $adherent->email }}</td>
<td>{{ $adherent->type }}</td>
<td> 
<form action="{{ route('adherents.destroy',$adherent->id) }}" method="POST">
<a class="btn btn-info" id="show-adherent" data-toggle="modal" data-id="{{ $adherent }}" >Show</a>
<a href="javascript:void(0)" class="btn btn-success" id="edit-adherent" data-toggle="modal" data-id="{{ $adherent->id }}">Edit </a>
<meta name="csrf-token" content="{{ csrf_token() }}">
<a id="delete-adherent" data-id="{{ $adherent->id }}" class="btn btn-danger delete-user">Delete</a></td>
</form>
</td>
</tr>
@endforeach

</table>
{!! $adherents->links() !!}
<!-- Add and Edit adherent modal -->
<div class="modal fade" id="crud-modal" aria-hidden="true" >
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="adherentCrudModal"></h4>
</div>
<div class="modal-body">
<form name="custForm" action="{{ route('adherents.index') }}" method="POST">
<input type="hidden" name="cust_id" id="cust_id" >
@csrf
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Nom:</strong>
<input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" onchange="validate()" >
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Prenom:</strong>
<input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prenom" onchange="validate()">
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
<strong>Type:</strong>
<input type="text" name="type" id="type" class="form-control" placeholder="Type" onchange="validate()">
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 text-center">
<button adherent="submit" id="btn-save" name="btnsave" class="btn btn-primary" disbaled >Submit</button>
<a href="{{ route('adherents.index') }}" class="btn btn-danger">Cancel</a>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<!-- Show adherent modal -->
<div class="modal fade" id="crud-modal-show" aria-hidden="true" >
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="adherentCrudModal-show"></h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-xs-2 col-sm-2 col-md-2"></div>
<div class="col-xs-10 col-sm-10 col-md-10 ">
@if(isset($adherent->nom))

<table>
<tr><td><strong>Nom:</strong></td><td id="nomshow">{{$adherent->nom}}</td></tr>
<tr><td><strong>Prenom:</strong></td><td id="prenomshow">{{$adherent->prenom}}</td></tr>
<tr><td><strong>Email:</strong></td><td id="emailshow">{{$adherent->email}}</td></tr>
<tr><td><strong>Type:</strong></td><td id="typeshow">{{$adherent->type}}</td></tr>
<tr><td colspan="2" style="text-align: right "><a href="{{ route('adherents.index') }}" class="btn btn-danger">OK</a> </td></tr>
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
	if(document.custForm.nom.value !='' && document.custForm.prenom.value !='' && document.custForm.email.value !='' && document.custForm.type.value !='')
	    document.custForm.btnsave.disabled=false
	else
		document.custForm.btnsave.disabled=true
}
</script>