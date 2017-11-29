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
<form  method="POST" action='/posts/{{$posts->id}}' enctype="multipart/form-data">
	{{ csrf_field() }}
	<input type='hidden' name='_method' value='PUT'>
	<input type="text" class="form-control" id='post_title' name='title' value = {{$posts->title}}>
	<input type="text" class="form-control" id='post_text' name='text' value = {{$posts->text}}>
	<select name='cat_id' class='form-control cat_sel'>
    	@foreach($my_categories as $my_category)
    		<option value={{$my_category->id}} @if($posts->cat_id == $my_category->id) selected @endif>
    		{{$my_category->title}}</option>
    	@endforeach
    </select>
 			<input type="file" class="filestyle" data-icon="false" name='image' style='margin-left:10px'> 	
	<button type="submit" class="btn btn-primary update_post">Update</button>
</form>	
@endsection