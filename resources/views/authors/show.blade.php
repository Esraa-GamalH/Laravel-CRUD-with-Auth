@extends('layouts.app')

@section('content')
<div class="card mt-5 w-50 m-auto">
    <h5 class="card-header bg-primary text-white">author Info</h5>
    <div class="card-body bg-primary-subtle">
        <h5 class="card-title">Name: {{$author->name}}</h5>
        <p>Email: {{$author->email}}</p>
        <a href="{{route("authors.index")}}" class="btn btn-primary">View All authors</a>
    </div>
</div>
@endsection