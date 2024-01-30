<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use App\Models\User;


class PostController extends Controller
{
        //     public function like(Request $request, Post $post)
        // {
        //     // Create a new like for the authenticated user and the specified post
        //     Like::create([
        //         'code_user' => auth()->user()->id,
        //         'code_post' => $post->id,
        //     ]);

        //     return back()->with('success', 'You liked the post.');
        // }

        // public function comment(Request $request, Post $post)
        // {
        //     // Validate the comment
        //     $request->validate([
        //         'comment' => 'required|string',
        //     ]);

        //     // Create a new comment for the authenticated user and the specified post
        //     Comment::create([
        //         'content' => $request->input('comment'),
        //         'code_user' => auth()->user()->id,
        //         'code_post' => $post->id,
        //     ]);

        //     return back()->with('success', 'Your comment has been added.');
        // }




       


















}
