<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function __construct(private PostRepository $repo) {}

    public function create($request)
    {
        return DB::transaction(function () use ($request) {
            $post = $this->repo->create([
                'title' => $request->title,
                'body' => $request->body,
                'user_id' => auth()->id(),
                'is_published' => true,
                'viewer' => $request->viewer
            ]);

            if ($request->hasFile('images')) {
                $this->repo->addImages($post, $request->file('images'));
            }

            return $post->load('images');
        });
    }

    public function getAllPost(){
        return $this->repo->all();
    }

    public function updatePost($id,$request){
        return DB::transaction(function () use ($id,$request){
            $post = $this->repo->updatePost($id,[
                'title' => $request->title,
                'body' => $request->body,
                'is_published' => $request->is_published,
                'viewer' => $request->viewer
            ]);

            if($request->hasFile('images')){
                $this->repo->addImages($post,$request->file('images'));
            }

            return $post->load('images');
        });
    }

    public function delete($id){
        return DB::transaction(function () use ($id) {
            return $this->repo->delete($id);
        });
    }



}
