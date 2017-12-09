@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class='row_second'>
            <h1>My Posts</h1>
            <button class="btn btn-success" id='add_post'><a href='{{url("posts/create")}}'>Add Post</a></button>
            @if(isset($my_posts))
                @foreach($my_posts as $my_post)
                    <div class='row_second_part'>
                        <ul  class='post_li'>
                            <li class="list-group-item" style='width:250px'>{{$my_post->category->title}}</li>
                            <li class="list-group-item" style='width:250px'>{{$my_post->title}}</li>
                            <li class="list-group-item" style='width:250px'>{{$my_post->text}}</li>
                            <li>
                            <img src='{{url("/image/$my_post->image")}}'></li>
                            <li style='display: inline-block'>
                                <button data-id="{{$my_post->id}}" type="button" class="btn btn-primary post_mod" data-toggle="modal" data-target="#exampleModal">
                                Delete
                                </button>
                            </li>
                            <li class="btn  btn-info" style='display: inline-block'><a href="{{url('posts/'.$my_post->id.'/edit')}}" id='ed'>Edit</a></li>
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
                <h5 class="modal-title" id="exampleModalLabel" style='text-align:center'>Are you sure you want to delete the post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                                    
            <div class="modal-footer">
                <form method='POST' action='' id='post_form'>
                    <input type='hidden' name='_method' value='DELETE'>
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-secondary" id='yes' style='margin-right:50px'>Yes</button>
                </form> 
                                          
                <button type="button" class="btn btn-default no" data-dismiss="modal">No</button>
                                            
            </div>
        </div>
    </div>
</div>
@endsection
