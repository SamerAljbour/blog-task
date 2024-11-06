<?php

// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Display all posts
    public function index()
    {
        $posts = Post::with(['comments', 'user'])->get();
        // dd($posts);
        return view('blog', compact('posts'));
    }

    // Show form for creating a new post
    public function create()
    {
        return view('posts.create');
    }

    // Store a new post in the database
    public function store(Request $request)
    {
        // Validate the incoming request

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create a new Post instance
        $post = new Post();

        // Assign the validated data to the Post model
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = $request->input('user_id');

        // Save the post to the database

        $post->save();
        // Redirect to the posts index page with a success message
        return redirect()->back()->with('success', 'Post created successfully');
    }

    // Show a single post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Show form for editing an existing post
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Update the post in the database
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    // Delete a post
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
