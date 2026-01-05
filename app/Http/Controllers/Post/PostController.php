<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource; // Import the resource

class PostController extends Controller {

    public function store(StorePostRequest $request, PostService $service) {
        $post = $service->create($request);

        return response()->json([
            // You can also use the resource for a single post
            'data' => new PostResource($post),
            'message' => 'Post created successfully'
        ], 201);
    }

    public function getAllPost(PostService $service){
        $posts = $service->getAllPost();

        if(!$posts){
            return response()->json(
                [
                    'message' =>'post not found'
                ],404
            );
        }

        return response()->json([
            // Use ::collection() to wrap the list of posts
            'data' => PostResource::collection($posts),
            'message' => 'get all posts successfully'
        ], 200);
    }

    public function updatePost(StorePostRequest $request , $id, PostService $service){
        $post = $service->updatePost($id,$request);
        if(!$post){
            return response()->json(
                [
                    'message' =>'post not found'
                ],404
            );
        }

        return response()->json(
            [
                'data' =>new PostResource($post),
                'message' => 'update Post successfully'
            ],201
        );
    }

    public function deletePost($id,PostService $service){

        $service->delete($id);

        return response()->json([
        'message' => 'Post and associated images deleted successfully'
    ], 200);
    }



}
