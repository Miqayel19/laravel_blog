@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class=row_cat>
            <h1 class='h1_post'>Categories</h1> 
            @if(isset($categories))
            <p style='margin-left:50px'> Number of Categories:{{count($categories)}}</p>
            @foreach($categories as $category)
                <ul style='list-style:none'>
                    <li class="list-group-item" style='width:200px'>{{$category->title}}</li>
                </ul>
            @endforeach
            @endif
        </div>
        <div class='row_post'>    
            <h1 class='h1_post'>Posts</h1>
            @if(isset($posts))
            <p style='margin-left: 50px'> Number of Posts:{{count($posts)}}</p>
            @foreach($posts as $post)
                <ul style='list-style:none'>
                    <li class="list-group-item" style='width:200px'>{{$post->title}}</li>
                </ul>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
