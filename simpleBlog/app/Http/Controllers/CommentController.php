<?php
// app/Http/Controllers/CommentController.php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Store a new comment
    public function store(Request $request, $postId)
    {
        // Validate the incoming request
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Create a new comment instance
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = Auth::id(); // Automatically set the logged-in user's ID
        $comment->post_id = $postId; // Set the related post ID

        // Save the comment to the database
        $comment->save();

        // Redirect back to the post with a success message
        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    // Edit an existing comment
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        // Check if the user owns the comment
        if ($comment->user_id != Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'You do not own this comment.');
        }

        return view('comments.edit', compact('comment'));
    }

    // Update an existing comment
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::findOrFail($id);

        // Check if the user owns the comment
        if ($comment->user_id != Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'You do not own this comment.');
        }

        $comment->content = $request->input('content');
        $comment->save();

        // Redirect back to the post with a success message
        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    // Delete a comment
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Check if the user owns the comment
        if ($comment->user_id != Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'You do not own this comment.');
        }

        $comment->delete();

        // Redirect back to the post with a success message
        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully.');
    }
}
