<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Display all posts
    public function index()
    {
        try {
            $posts = Post::with(['comments', 'user'])->get();
            return view('blog', compact('posts'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong while loading the posts. Please try again later.');
        }
    }

    // Show form for creating a new post
    public function create()
    {
        return view('posts.create');
    }

    // Store a new post in the database
    public function store(Request $request)
    {
        try {
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
            $post->user_id = $request->input('user_id');  // Assuming user_id is passed from the form

            // Save the post to the database
            $post->save();

            // Redirect to the posts index page with a success message
            return redirect()->back()->with('success', 'Your post has been created successfully!');
        } catch (\Exception $e) {
            // Catch any exceptions and return an error message
            return redirect()->back()->with('error', 'There was an issue creating the post. Please try again.');
        }
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
    public function update(Request $request, string $postId)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            // Find the post
            $post = Post::find($postId);

            // Check if post exists
            if (!$post) {
                return redirect()->back()->with('error', 'Post not found. It might have been deleted or does not exist.');
            }

            // Assign the validated data to the Post model
            $post->title = $request->input('title');
            $post->content = $request->input('content');

            // Save the post to the database
            $post->save();

            // Redirect to the posts index page with a success message
            return redirect()->back()->with('success', 'Your post has been updated successfully!');
        } catch (\Exception $e) {
            // Catch any exceptions and return an error message
            return redirect()->back()->with('error', 'There was an issue updating the post. Please try again later.');
        }
    }

    // Delete a post
    public function destroy(string $postId)
    {
        try {
            $post = Post::find($postId);

            // Check if the post exists
            if (!$post) {
                return redirect()->back()->with('error', 'Post not found. It might have already been deleted.');
            }

            // Delete the post
            $post->delete();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Your post has been deleted successfully.');
        } catch (\Exception $e) {
            // Catch any exceptions and return an error message
            return redirect()->back()->with('error', 'There was an issue deleting the post. Please try again later.');
        }
    }
}
