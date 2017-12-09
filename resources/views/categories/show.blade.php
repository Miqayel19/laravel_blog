@extends('layouts.app')
@section('content')
<div class ="container">
    <div class="row">
        <div class='row_post'>    
            <h1 class='h1_post'>Posts</h1>
                <p> Number of Posts:{{count($category->posts)}}</p>
                @foreach($category->posts as $post)
                    <ul class='post_ul'>
                        <li class="list-group-item">{{$post->title}}</li>
                    </ul>
                @endforeach
        </div>
    </div>
</div>
@endsection
