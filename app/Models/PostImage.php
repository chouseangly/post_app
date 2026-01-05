<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $table = 'post_images';

    // If you changed the ID name in migration to 'image_id'
    protected $primaryKey = 'image_id';

    protected $fillable = [
        'post_id',
        'img_url' // Make sure this matches your migration
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
