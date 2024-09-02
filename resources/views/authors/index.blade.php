@extends('layouts.app')

@section('content')


    <table class="table table-success table-striped mt-5 w-75 m-auto text-center">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        @foreach ($authors as $author)
            <tr>
                <td>{{$author->id}}</td>
                <td>{{$author->name}}</td>
                <td>{{$author->email}}</td>
                <td>
                    <a href="{{route("authors.show", $author)}}" class="btn btn-info">View</a>
                    {{-- <a href="{{route("authors.destroy", $author)}}" class="btn btn-danger">Delete</a> --}}
                </td>
            </tr>
        @endforeach

    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $authors->links() }}
    </div>
    



@endsection