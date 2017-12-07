@extends('layouts.app')
@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form  method="POST" action='/posts' enctype="multipart/form-data">
	{{ csrf_field() }}
	<input type="text" class="form-control post_title" placeholder="Add Title"  name='title'>
	<input type="text" class="form-control post_text" placeholder="Add Text"  name='text'>
	<select name='cat_id' class='form-control post_cat_id'>
    	@foreach($my_categories as $my_category)
    		<option value={{$my_category->id}}>{{$my_category->title}}</option>
    	@endforeach
    </select>
    <div class="form-group post_form">
 		<input type="file" class="filestyle" data-icon="false" name='image'>
 	</div>
	<button type="submit" class="btn btn-danger post_but">Add</button>
</form>	
@endsection
