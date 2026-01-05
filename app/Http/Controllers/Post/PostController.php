<?php

namespace App\Http\Controllers;

use PostService;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function store(StorePostRequest $request, PostService $service)
    {
        return response()->json([
            'data' => $service->create($request),
            'message' => 'Post created successfully'
        ], 201);
    }
}

