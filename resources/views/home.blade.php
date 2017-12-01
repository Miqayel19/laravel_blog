@extends('layouts.app')
@section('content')
<div class ="container">
    <div class="row">
        <div class=row_cat>
            <h1 class='h1_post'>Categories</h1> 
            @if(isset($categories))
            <p> Number of Categories:{{count($categories)}}</p>
            @foreach($categories as $category)
                <ul class='cat_ul'>
                    <li class="list-group-item"><a href='{{url("categories/".$category->id)}}'>{{$category->title}}</a></li>
                </ul>
            @endforeach
            @endif
        </div>
        <div class='row_post'>    
            <h1 class='h1_post'>Posts</h1>
            @if(isset($posts))
            <p> Number of Posts:{{count($posts)}}</p>
            @foreach($posts as $post)
                <ul class='post_ul'>
                    <li class="list-group-item">{{$post->title}}</li>
                </ul>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
