<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request , $postId, CommentService $service){
        $request->validate(['content'=>'required|string|max:255']);
        $comment = $service->create($postId,$request->content);

        return response()->json([
            'data' => $comment,
            'message' => 'Comment added successfully'
        ], 201);
    }


}
