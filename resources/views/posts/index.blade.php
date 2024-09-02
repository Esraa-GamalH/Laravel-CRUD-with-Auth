@extends('layouts.app')

@section('content')
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Toggle between all posts and trashed posts -->
    <div class="row text-center">
        <div class="mb-3 col-6">
            <a href="{{ route('posts.create') }}" class="btn btn-primary mt-3">Create new Post</a>
        </div>
        <div class="mb-3 col-6">
            @if($showTrashed)
                <a href="{{ route('posts.index') }}" class="btn btn-primary mt-3">View All Posts</a>
            @else
                <a href="{{ route('posts.index', ['trashed' => true]) }}" class="btn btn-warning mt-3">View Trashed Posts</a>
            @endif
        </div>
    </div>


    <table class="table table-success table-striped mt-5 m-auto text-center">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Posted By</th>
            <th>Created At</th>
            <th>Image</th>
            <th>Actions</th>
            <th>Delete</th>
            @if($showTrashed)
                <th>Restore</th>
            @endif
        </tr>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->author->name }}</td>
                <td>{{ $post->created_at }}</td>
                <td>
                    @if($post->image)
                        <img src="{{ asset('images/posts/images/' . $post->image) }}" width="100" height="100" alt="Post Image">
                    @else
                        No Image
                    @endif
                </td>
                <td>
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-info">View</a>
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                </td>
                @if($showTrashed)
                    <td>
                        <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                            @csrf
                            <input type="submit" class="btn btn-warning" value="Restore">
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
@endsection

<script type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure you want to delete this post?');
    }
</script>
