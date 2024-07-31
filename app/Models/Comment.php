<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'idea_id',
        'content'
    ];

    //relation to comments -> user : a comments belongs to a user. (many to one)
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function idea(){
        return $this->belongsTo(Idea::class);
    }





}
