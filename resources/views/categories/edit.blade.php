@extends('layouts.app')
@section('content')
<div>
    <form  method="POST" action='/categories/{{$category->id}}'>
        {{ csrf_field() }}
        <input type='hidden' name='_method' value='PUT'>
        <input type="text" class="form-control edit_cat" name='title' value = {{$category->title}}>
        <button type="submit" class="btn btn-primary update_cat">Update</button>
    </form>
</div>  
@endsection