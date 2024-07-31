<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //getting the current user's following
        $followingIDs = auth()->user()->followings()->pluck('user_id');
         /*
            //getting only the followers of a user
            // $ideas = Idea::WhereIn('user_id',$followingIDs)->latest();

            if(request()->has('search')){
                $ideas = $ideas->search(request('search',''));
            }
        */
       $ideas = Idea::when(request()->has('search'), function($query){
            $query->search(request('search', '')); //scopeSearch in Idea Model
       })->whereIn('user_id', $followingIDs)->latest()->paginate(5);

        //display the post stored from the database
        // return view('dashboard', ['ideas'=> $ideas->paginate(5)]);
        return view('dashboard',compact('ideas'));
    }
}
