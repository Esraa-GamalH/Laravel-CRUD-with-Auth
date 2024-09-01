<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;


class postController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $posts = Post::all();
        $showTrashed = $request->has('trashed');

        if ($showTrashed) {
            $posts = Post::onlyTrashed()->paginate(3);
        } else {
            $posts = Post::paginate(3);
        }

        return view('posts.index', compact('posts', 'showTrashed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        return view('posts.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
    # save image  --> inside public path
        $image_path= null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_path=$image->store("", 'posts_images');
        }
        $request_data= $request->validated();
        $request_data['image']=$image_path; # replace image object with image_uploaded path

        //save data to DB using mass assignment
        $post = Post::create($request_data);
        return to_route('posts.show', $post);
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // $author = Author::find($post->author_id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        $authors = Author::all();
        return view("posts.edit", compact('post', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
        
        $image_path= $post->image;

        if($request->hasFile('image')){
            # delete old_image
            $image = $request->file('image');
            $image_path=$image->store("images", 'posts_images');
        }
        $request_data= $request->validated();
        $request_data['image']=$image_path; # replace image object with image_uploaded path

        //save data to DB using mass assignment
        $post->update($request_data);
        return to_route('posts.show', $post);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        // Delete the image when post is deleted
        // if ($post->image) {
        //     Storage::disk('posts_images')->delete($post->image);
        // }
        //
        $post->delete();
        return to_route('posts.index')->with('success', 'post deleted successfully');
    }

    public function restore($id){
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('posts.index')->with('success', 'Post restored successfully');
    }


}
