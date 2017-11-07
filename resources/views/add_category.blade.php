@extends('layouts.app')
@section('content')
<form  method="POST" action='/categories/store'>
	{{ csrf_field() }}
	<input type="text" class="form-control" placeholder="Add Category"  name='title' style='width:150px;margin-left:10px;display: inline-block'>
	<button type="submit" class="btn btn-danger" style='display: inline-block'>Add</button>
</form>
@endsection
