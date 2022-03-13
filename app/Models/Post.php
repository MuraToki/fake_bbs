<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'content',
        'title',
        'image'
    ];

    public function category() {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    } 

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    } 

    public function comment() {
        return $this->hasMany(\App\Models\Comment::class, 'post_id', 'id');
    } 

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

}
