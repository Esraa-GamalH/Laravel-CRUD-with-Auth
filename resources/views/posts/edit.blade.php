@extends('layouts.app')

@section('container')
<h1 class="text-success text-center">Edit Post</h1>

    <form class="w-50 m-auto mt-5" action="{{route("posts.update", $post)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
            @error('title')
                <div class="alert alert-danger mt-1">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" rows="3" name="description">{{ $post->description }}</textarea>
            @error('description')
                <div class="alert alert-danger mt-1">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="createdAt" class="form-label">Created At</label>
            <input type="datetime-local" class="form-control" id="createdAt" name="createdAt" value="{{ $post->createdAt}}">
            @error('createdAt')
                <div class="alert alert-danger mt-1">{{$message}}</div>
            @enderror
        </div>
        <div>
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            <img src="{{asset('images/posts/images/'.$post->image)}}" width="100" height="100">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Post author</label>
            <select class="form-select" name="author_id">
                <option disabled selected>Please choose an author for the post</option>
                @foreach($authors as $author)
                    @if($post->author_id == $author->id)
                        <option value="{{$author->id}}" selected>{{$author->name}}</option>
                    @else
                        <option value="{{$author->id}}">{{$author->name}}</option>
                    @endif
                @endforeach
            </select>
            @error('author_id')
                <div class="alert alert-danger mt-1">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-info">Update</button>
    </form>
@endsection