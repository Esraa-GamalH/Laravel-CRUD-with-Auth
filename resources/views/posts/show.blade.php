@extends('layouts.app')

@section('content')
<div class="card mt-5 w-50 m-auto">
    <h5 class="card-header bg-primary text-white">Post Info</h5>
    <div class="card-body bg-primary-subtle">
        <img src="{{asset('images/posts/images/'.$post->image)}}" class="card-img-top">
        <h5 class="card-title">Title: {{$post->title}}</h5>
        <h5 class="card-title">Slug: {{$post->slug}}</h5>
        <p>Description: {{$post->description}}</p>

        <h6><strong> Created By: {{ $post->creator ? $post->creator->name : 'unknown' }}</strong></h6>
        <p class="card-text">Created_at: {{$post->human_readable_date}}</p>
        <p class="card-text">Updated_at: {{$post->updated_at}}</p>
        <a href="{{route("posts.index")}}" class="btn btn-primary">View All Posts</a>
    </div>
</div>
@endsection