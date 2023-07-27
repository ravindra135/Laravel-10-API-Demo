<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Post;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * posts() -> prural as belong to many posts
     * $this-> refers to User Model
     * 
     * belongsToManay(a, b, c, d) -> As single user can be involved in many different posts
     * -> a = Model Related to User Model
     * -> b = Pivot Table shares relationship between user and post
     * -> c = foreign pivot key
     * -> d = related pivot key
     */
    public function posts() {
        return  $this->belongsToMany(Post::class, 'post_user', 'user_id', 'post_id');
    }
}
