@extends('layouts.app')
@section('content')
<div>
    <form  method="POST" action='/categories/delete'>
        {{ csrf_field() }}
        <input type="text" class="form-control" placeholder="Title"  name='title' style='width:150px'>
        <button type="submit" class="btn btn-primary">Delete</button>
    </form>
</div>  
@endsection