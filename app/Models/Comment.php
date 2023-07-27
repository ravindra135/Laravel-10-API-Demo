<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $casts = [
        'body' => 'array',
    ];

    /**
     * Belong To Relationship
     * ----------------------
     * post -> is a singular noun as it is on one-to-many 
     * $this -> refers to the Comment Model
     * belongsTo() -> It Belong to the Post Model;
     * ----------------------
     */
    public function post() {
        return $this->belongsTo(Post::class, 'post_id');
    }

}
