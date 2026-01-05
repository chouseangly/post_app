<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'is_published',
        'viewer'
    ];

    public function images(){
        return $this->hasMany(PostImage::class);
    }

    public function latestFiveImages() {
    return $this->hasMany(PostImage::class)->limit(5);
}


}
