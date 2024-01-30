<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;


class PublicHomeController extends Controller
{
    // PublicHomeController.php

    // public function studentHome()
    // {

    //     $posts = Post::with('user', 'comments')->get();
    //     $posts->load(['likes' => function ($query) {
    //         $query->where('code_user', auth()->id());
    //     }]);



    //     return view('student-pub.home', ['posts' => $posts]);
    // }

    public function studentHome(Request $request)
    {
        // Get the authenticated student user
        $user = auth()->user(); // Assuming the student is the authenticated user

        // Retrieve the group ID to which the student belongs (replace 'code_group' with the actual column name)
        // $groupId = $user->student->code_group; // Replace 'code_group' with the actual column name in your 'users' table
        $groupId = optional($user->student)->code_group;

        // dd($groupId);
        // // Fetch posts that belong to the student's group
        // $posts = Post::with('user', 'comments')
        //     ->whereHas('groups', function ($query) use ($groupId) {
        //         $query->where('code_group', $groupId);
        //     })
        //     ->get();
        // Fetch posts that belong to the student's group or are shared with all groups
        $posts = Post::with('user', 'comments')
        ->where(function ($query) use ($groupId) {
            $query->whereHas('groups', function ($groupQuery) use ($groupId) {//$groupQuery is a query builder instance
                $groupQuery->where('code_group', $groupId); // Fetch posts that belong to the student's group
            })->orWhereDoesntHave('groups');  //is used to include posts that are not associated with any groups, effectively meaning they are shared with all groups.
        })
        ->get();

        // Load likes for the current user
        $posts->load(['likes' => function ($query) {
            $query->where('code_user', auth()->id());
        }]);

        // Pass the posts to the view
        return view('student-pub.home', ['posts' => $posts]);
    }




        public function isLiked($postId)
    {
        return Like::where('code_user', auth()->id())
            ->where('code_post', $postId)
            ->exists();
    }

        public function likePost(Request $request)
    {
        $postId = $request->post('post_id');
        $user = auth()->user();

        $like = Like::where('code_user', $user->id)
            ->where('code_post', $postId)
            ->first();

        if ($like) {
            $like->delete();
            $isLiked = false;
        } else {
            $like = new Like([
                'code_user' => $user->id,
                'code_post' => $postId,
                'is_like' => true,
            ]);
            $like->save();
            $isLiked = true;
        }

        return response()->json(['success' => true, 'isLiked' => $isLiked]);
    }


    public function addComment(Request $request)
    {
        $postId = $request->post('post_id');
        $content = $request->post('content');
        $user = auth()->user();

        $comment = new Comment([
            'code_user' => $user->id,
            'code_post' => $postId,
            'content' => $content,


        ]);
        $comment->save();

        return response()->json(['success' => true, 'comment' => $comment]);
    }


    // public function deleteComment($id)
    // {
    //     $comment = Comment::find($id);

    //     if (!$comment) {
    //         return response()->json(['success' => false, 'message' => 'Comment not found']);
    //     }

    //     // Check if the user is authorized to delete the comment (you can use policies or other methods).
    //     // You can also check if the currently authenticated user is the owner of the comment.

    //     // Perform the deletion.
    //     $comment->delete();

    //     return response()->json(['success' => true, 'message' => 'Comment deleted']);
    // }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['success' => false, 'message' => 'Comment not found']);
        }

        // Check if the authenticated user is the owner of the comment.
        if ($comment->code_user === auth()->id()) {
            // Perform the deletion.
            $comment->delete();

            return response()->json(['success' => true, 'isOwner' => true, 'message' => 'Comment deleted']);
        }

        return response()->json(['success' => true, 'isOwner' => false, 'message' => 'You are not the owner of this comment']);
    }





}
