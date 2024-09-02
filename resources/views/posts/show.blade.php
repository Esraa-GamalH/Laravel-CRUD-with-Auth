@extends('layouts.app')

@section('content')
<div class="card mt-5 w-50 m-auto">
    <h5 class="card-header bg-primary text-white">Post Info</h5>
    <div class="card-body bg-primary-subtle">
        <img src="{{asset('images/posts/images/'.$post->image)}}" class="card-img-top">
        <h5 class="card-title">Title: {{$post->title}}</h5>
        <p>Description: {{$post->description}}</p>

        {{-- @if($post->author)
            <p class="card-text" > <a href="{{route("posts.show", $post->author)}}"> {{$post->author->name}}</a> </p>
        @else
            <p class="card-text" ><strong>unKnown</strong></p>
        @endif --}}

        {{-- <h6>Posted By: {{ $post->author ? $post->author->name : 'Not Known' }}</h6> --}}
        <h6><strong> Created By: {{ $post->creator ? $post->creator->name : 'unknown' }}</strong></h6>
        <p class="card-text">Created_at: {{$post->created_at}}</p>
        <p class="card-text">Updated_at: {{$post->updated_at}}</p>
        <a href="{{route("posts.index")}}" class="btn btn-primary">View All Posts</a>
    </div>
</div>
@endsection