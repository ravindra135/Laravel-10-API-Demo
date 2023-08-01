<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Post;
use App\Notifications\PostSharedNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;

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

    public function share(Request $request, Post $post)
    {
        $url = URL::temporarySignedRoute('shared.post', now()->addDays(30),[
            'post' => $post->id,
        ]);

        $users = User::query()->whereIn('id', $request->user_ids)->get();

        Notification::send($users, new PostSharedNotification($post, $url));

        $user = User::query()->find(1);
        $user->notify(new PostSharedNotification($post, $url));

        return new JsonResponse([
            'data' => $url,
        ]);
    }
}
