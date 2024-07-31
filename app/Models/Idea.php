<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;
    protected $with = ['user:id,name,image', 'comments.user:id,name,image'];

    protected $withCount = ['likes'];

    /*     protected $guarded = [
           'id',
           'created_at',
           'updated_at',
    ]; */


    protected $fillable = [
        'user_id',
        'content',
    ];

    //relation to idea -> comments : an idea can have many comments (one to many)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //relation to idea -> user : an ideas is belong to a user. (many to one)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //likes idea_like
    public function likes()
    {
        return $this->belongsToMany(User::class,'idea_like')->withTimestamps();
    }

    //scope for search user tob e reusable in many controller
    public function scopeSearch(Builder $query, $search = ''){
       $query->where('content','like','%'. $search.'%');
    }
}
