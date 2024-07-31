<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowerController extends Controller
{
    //
    public function follow(User $user){
        $follower = auth()->user();
        $follower->followings()->attach($user);

        return redirect()->route('users.show', $user->id)->with('success','Followed successfully!');//adds the relation of user to another user
    }

    public function unfollow(User $user){
        $follower = auth()->user();
        $follower->followings()->detach($user); //remove the relation of user to another user

        return redirect()->route('users.show', $user->id)->with('success','Unfollowed successfully!');
    }
}

