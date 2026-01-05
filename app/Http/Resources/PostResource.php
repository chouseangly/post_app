<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'user_id' => $this->user_id,
            'is_published' => (bool) $this->is_published,
            'viewer' => $this->viewer,
            // This turns the images collection into a simple list of URLs
            'images' => $this->images->pluck('img_url'),
            'created_at' => $this->created_at,
        ];
    }
}
