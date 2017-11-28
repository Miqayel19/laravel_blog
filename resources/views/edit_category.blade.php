@extends('layouts.app')
@section('content')
<div>
<form  method="POST" action='/categories/{{$categories->id}}'>
	{{ csrf_field() }}
	<input type='hidden' name='_method' value='PUT'>
	<input type="text" class="form-control" name='title' value = {{$categories->title}} style='width:200px;margin-left:10px;display:inline-block'>
	<button type="submit" class="btn btn-primary" style='display: inline-block'>Update</button>
</form>
</div>	
@endsection