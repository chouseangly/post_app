<?php

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
            ]);

            if ($request->hasFile('images')) {
                $this->repo->addImages($post, $request->file('images'));
            }

            return $post->load('images');
        });
    }
}
