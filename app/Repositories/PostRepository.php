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
                'img_url' => $stored['url'], // Use 'url' from the storage service
            ]);
        }
    }

    public function all()
    {
        return Post::with('latestFiveImages')->first()->get();
    }

    public function updatePost(int $id, array $data): Post
    {
        $post = Post::findOrFail($id);
        $post->update($data);
        return $post;
    }

    public function delete($id){
        $post = Post::findOrFail($id);
       return $post->delete();
    }


}
