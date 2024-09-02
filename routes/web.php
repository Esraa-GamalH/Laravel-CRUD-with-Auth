<?php

use Illuminate\Support\Facades\Route;



// Route::get('/posts', [postController::class, "index"])->name("posts.index");
// Route::get('/posts/create', [postController::class, "create"])->name("posts.create");
// Route::get('/posts/{id}', [postController::class, "show"])->name("posts.show")->where('id', '[0-9]+');
// Route::get('/posts/{id}/edit', [postController::class, "edit"])->name("posts.edit")->where('id', '[0-9]+');
// Route::get('/posts/{id}/destroy', [postController::class, "destroy"])->name("posts.destroy")->where('id', '[0-9]+');
// ### create new object
// # http request method --> post
// Route::post("/posts", [postController::class, 'store'])->name("posts.store");
// Route::post("/posts/{id}", [postController::class, 'update'])->name("posts.update")->where('id', '[0-9]+');

// generate route from resource controller
use App\Http\Controllers\postController;

Route::resource('posts', postController::class);
Route::post('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');

use App\Http\Controllers\AuthorController;

Route::resource('authors', AuthorController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
