

@include('layouts.app')

@extends('coachs.layout')
@section('content')
<div class="container">
@include('layouts.navbar')
                

                
          
</div>

<div class="row">
<div class="col-lg-12" style="text-align: center">
<div >
<h2>Laravel 7 CRUD using Bootstrap Modal</h2>
</div>
<br/>
</div>
</div>
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-right">
<a href="javascript:void(0)" class="btn btn-success mb-2" id="new-coach" data-toggle="modal">New Coach</a>
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
<th width="280px">Action</th>
</tr>

@foreach ($coachs as $coach)
<tr id="coach_id_{{ $coach->id }}">
<td>{{ $coach->id }}</td>
<td>{{ $coach->nom }}</td>
<td>{{ $coach->prenom }}</td>
<td>{{ $coach->email }}</td>
<td> 
<form action="{{ route('coachs.destroy',$coach->id) }}" method="POST">
<a class="btn btn-info" id="show-coach" data-toggle="modal" data-id="{{ $coach }}" >Show</a>
<a href="javascript:void(0)" class="btn btn-success" id="edit-coach" data-toggle="modal" data-id="{{ $coach->id }}">Edit </a>
<meta name="csrf-token" content="{{ csrf_token() }}">
<a id="delete-coach" data-id="{{ $coach->id }}" class="btn btn-danger delete-user">Delete</a></td>
</form>
</td>
</tr>
@endforeach

</table>
{!! $coachs->links() !!}
<!-- Add and Edit coach modal -->
<div class="modal fade" id="crud-modal" aria-hidden="true" >
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="coachCrudModal"></h4>
</div>
<div class="modal-body">
<form name="custForm" action="{{ route('coachs.index') }}" method="POST">
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

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
<button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disbaled >Submit</button>
<a href="{{ route('coachs.index') }}" class="btn btn-danger">Cancel</a>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<!-- Show coach modal -->
<div class="modal fade" id="crud-modal-show" aria-hidden="true" >
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="coachCrudModal-show"></h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-xs-2 col-sm-2 col-md-2"></div>
<div class="col-xs-10 col-sm-10 col-md-10 ">
@if(isset($coach->name))

<table>
<tr><td><strong>Nom:</strong></td><td id="nomshow">{{$coach->nom}}</td></tr>
<tr><td><strong>Prenom:</strong></td><td id="prenomshow">{{$coach->prenom}}</td></tr>
<tr><td><strong>Email:</strong></td><td id="emailshow">{{$coach->email}}</td></tr>
<tr><td colspan="2" style="text-align: right "><a href="{{ route('coachs.index') }}" class="btn btn-danger">OK</a> </td></tr>
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
	if(document.custForm.nom.value !='' && document.custForm.prenom.value !='' && document.custForm.email.value !='' )
	    document.custForm.btnsave.disabled=false
	else
		document.custForm.btnsave.disabled=true
}
</script>