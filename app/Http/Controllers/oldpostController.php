<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;

class postController extends Controller
{

    public function index()
    {
        // $post = DB::table('posts')->get();
        // $posts = Post::all();
        $posts = Post::paginate(3);
        foreach($posts as $post){
            $post->formattedCreatedAt = Carbon::parse($post->createdAt)->format('F j, Y, g:i a');
        }
        return view('index', ["posts" => $posts]);
    }


    public function create()
    {
        $posts = DB::table('posts')->get();
        return view('create', ["posts" => $posts]);
    }


    public function show($id)
    {
        $post = Post::find($id);
        if ($post) {

            // using carbon to format date
            $post->formattedCreatedAt = Carbon::parse($post->createdAt)->format('F j, Y, g:i a');
            return view('show', ["post" => $post]);
        }
        abort(404);
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('edit', ["post" => $post]);
    }


    public function update(Request $request, $id)
    {
        $valid_data = $request->validate([
            "title" => "sometimes|required|max:255|unique:posts,title,$id",
            "postedBy" => "sometimes|required",
            "description" => "sometimes|required",
            "createdAt" => "sometimes|required|date",
        ]);
    

        $post = Post::findOrFail($id);
        $post->update($valid_data);

        return redirect()->route('posts.show', $post->id);
    }


    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return to_route("posts.index");
        }
        abort(404);
    }


    public function store()
    {
        //Validation
        $valid_data = request()->validate([
            "title" => "required|unique:posts| max:255",
            "postedBy" => "required",
            "description" => "required",
            "createdAt" => "required"
        ]);

        # if form is not valid  --> redirect to the html page
        $requested_data = request()->all();
        $post = new Post();
        $post->title = $requested_data['title'];
        $post->createdAt = $requested_data['createdAt'];
        $post->description = $requested_data['description'];
        $post->postedBy = $requested_data['postedBy'];
        $post->save();
        return to_route("posts.show", $post->id);
    }
}
