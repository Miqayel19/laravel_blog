@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class='row_second'>
        	<h1>My Categories</h1>
        	<button class="btn btn-success" id='add_cat'><a href='{{url("categories/create")}}'>Add Category</a></button>
        	
        	@if(isset($my_categories))
        	@foreach($my_categories as $my_category)
        	<div class='row_second_part'>
	        	<ul class='ul_cat'>
	        		<li class="list-group-item" id='list_cat'>{{$my_category->title}}</li>
	        		<li>
	        				<button data-id="{{$my_category->id}}" type="button" class="btn btn-primary delete_mod" data-toggle="modal" data-target="#exampleModal">
  							Delete
							</button>
							
	        		</li>
	       			<li class="btn  btn-info"><a href='{{url("categories/".$my_category->id."/edit")}}' id='ed'>Edit</a></li>
	        	</ul>
	        </div>	
	        @endforeach
	        @endif

    	</div>
	</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel" style='text-align:center'>Are you sure you want to delete the category</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
        	<div class="modal-footer">
      			<form method='POST' action='' id='category_form'>
	  				<input type='hidden' name='_method' value='DELETE'>
					{{csrf_field()}}
        			<button type="submit" class="btn btn-secondary" id='yes'>Yes</button>
        		</form>	
               	<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
    	</div>
  	</div>
</div>

@endsection
