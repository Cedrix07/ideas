<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'is_admin',
        'name',
        'bio',
        'image',
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

    //relation to user -> Ideas : a user can have many ideas (one to many)
    public function Ideas(){
        return $this->hasMany(Idea::class)->latest();
    }

    //relation to user->comments : a user can have many comments (one to many)
    public function comments(){
        return $this->hasMany(Comment::class)->latest();
    }

    public function getImageURL(){
        if($this->image){
            return url('storage/'. $this->image);
        }
        return "https://api.dicebear.com/6.x/fun-emoji/svg?seed={$this->name}";
    }

    /*
        Relation of current user he/she's following
        follower_id = our_id
        user_id = followed user_Id
    */
    public function followings(){
        return $this->belongsToMany(User::class, 'follower_user','follower_id', 'user_id')->withTimestamps();
    }
     //Relation of other user following the current user
    public function followers(){
        return $this->belongsToMany(User::class, 'follower_user', 'user_id','follower_id')->withTimestamps();
    }

    //check if the user already followed another particular user
    public function follows(User $user){
        return $this->followings()->where('user_id',  $user->id)->exists();
    }

     //likes idea_like
     public function likes()
     {
         return $this->belongsToMany(Idea::class,'idea_like')->withTimestamps();
     }

     public function likesIdea(Idea $idea){
        return $this->likes()->where('idea_id',  $idea->id)->exists();
    }
}
