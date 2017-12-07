@extends('layouts.app')
@section('content')
<div class ="container">
    <div class="row">
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
