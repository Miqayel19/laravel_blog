@extends('layouts.app')
@section('content')
<form  method="POST" action='/categories'>
    {{ csrf_field() }}
    <input type="text" class="form-control add_cat" placeholder="Add Category"  name='title'>
    <button type="submit" class="btn btn-danger add_but">Add</button>
</form>
@endsection
