<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /** 
     * Casting is a class property that casts an attribute to a datatype.
     * 
     * By Casting body => array,
     * 
     * laravel will automatically convert the body between JSON -><- Array
     * So, we don't need to call jsonEncode or jsonDecode PHP functions.
     */
    protected $casts = [
        'body' => 'array',
    ];

    protected $fillable = [
        'title', 'body'
    ];

    //-> Accessors { Getters } & Mutators { Setters }

    // Accessors = Gets From DB -> Modifies IT -> Shows
    public function getTitleUpperCaseAttribute() {
        return strtoupper($this->title);
    }

    // Mutators  = Gets $value from User -> Modifies It -> Updates it in DB
    public function setTitleAttribute($value) {
        $this->attributes['title'] = strtolower($value);
    }

    //-> Relationships

    /**
     * HasMany Relationship
     * --------------------
     * comments() -> is prural as it has many relation.
     * $this -> refers to Post Model.
     * hasMany(a, b) -> As single Post has many Comments
     * -> a = Child class here is comment
     * -> b = foreignKey.
     * --------------------
     */
    public function comments() {
        return $this->hasMany(Comment::class, 'post_id');
    }

    /**
     * BelongsTo Many Relationship
     * ---------------------------
     * users() -> prural as is it belong to Many Users
     * $this-> refers to Post Model.
     * 
     * belongsToMany(a,b,c,d) -> As single Post can written and modified by many users;
     * -> a = related to User Model;
     * -> b = pivot table post_user;
     * -> c = foreign Pivot key post_id;
     * -> d = related pivot key user_id;
     */
    public function users() {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
    }
}
