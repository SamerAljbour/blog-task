<?php

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
        if (!Auth::user())
            return redirect()->back()->with('error', 'login to comment on blogs');

        try {
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
            return redirect()->back()->with('success', 'Your comment has been posted successfully.');
        } catch (\Exception $e) {
            // Catch any exceptions and return an error message
            return redirect()->back()->with('error', 'Something went wrong while posting your comment. Please try again later.');
        }
    }

    // Edit an existing comment
    public function edit($id)
    {
        try {
            $comment = Comment::findOrFail($id);

            // Check if the user owns the comment
            if ($comment->user_id != Auth::id()) {
                return redirect()->back()->with('error', 'You can only edit your own comments.');
            }

            return view('comments.edit', compact('comment'));
        } catch (\Exception $e) {
            // Catch any exceptions and return an error message
            return redirect()->back()->with('error', 'An error occurred while trying to load your comment. Please try again later.');
        }
    }

    // Update an existing comment
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'content' => 'required|string|max:1000',
            ]);

            $comment = Comment::findOrFail($id);

            // Check if the user owns the comment
            if ($comment->user_id != Auth::id()) {
                return redirect()->route('posts.index')->with('error', 'You can only update your own comments.');
            }

            $comment->content = $request->input('content');
            $comment->save();

            // Redirect back to the post with a success message
            return redirect()->back()->with('success', 'Your comment has been updated successfully.');
        } catch (\Exception $e) {
            // Catch any exceptions and return an error message
            return redirect()->back()->with('error', 'Something went wrong while updating your comment. Please try again later.');
        }
    }

    // Delete a comment
    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);

            // Check if the user owns the comment
            if ($comment->user_id != Auth::id()) {
                return redirect()->back()->with('error', 'You can only delete your own comments.');
            }

            $comment->delete();

            // Redirect back to the post with a success message
            return redirect()->back()->with('success', 'Your comment has been deleted successfully.');
        } catch (\Exception $e) {
            // Catch any exceptions and return an error message
            return redirect()->back()->with('error', 'Something went wrong while deleting your comment. Please try again later.');
        }
    }
}
