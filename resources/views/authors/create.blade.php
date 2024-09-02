@extends('layouts.app')

@section('content')
    <h1 class="text-success text-center">Add New Author</h1>

    <form class="w-50 m-auto mt-5" action="{{route("authors.store")}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="alert alert-danger mt-1">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <div class="alert alert-danger mt-1">{{$message}}</div>
            @enderror
        </div>
        
        
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection