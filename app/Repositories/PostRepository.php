<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\ImageStorage\ImageStorageInterface;

class PostRepository
{
    //constructor injection
    public function __construct(
        private ImageStorageInterface $imageStorage
    ) {}

    public function create(array $data): Post
    {
        return Post::create($data);
    }

    public function addImages(Post $post, array $images): void
    {
        foreach ($images as $image) {
            $stored = $this->imageStorage->store($image);

            $post->images()->create([
                'cid' => $stored['cid'],
                'gateway_url' => $stored['url'],
            ]);
        }
    }

    public function all()
{
   return Post::with('latestFiveImages')->latest()->get();
}
}
