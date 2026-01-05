<?php

namespace App\Http\Controllers\Post; // Updated namespace

use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller {
    public function store(StorePostRequest $request, PostService $service) {
        return response()->json([
            'data' => $service->create($request),
            'message' => 'Post created successfully'
        ], 201);
    }

    public function getAllPost(PostService $service){
        $posts = $service->getAllPost();
          return response()->json([
            'data' => $posts,
            'message' => 'get all posts successfully'
        ], 201);
    }
}
