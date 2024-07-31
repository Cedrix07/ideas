<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $ideas = Idea::when(request()->has('search'), function(Builder $query){
            $query->search(request('search', '')); //scropeSearch in Idea Model
        })->orderBy('created_at', 'DESC')->paginate(5);

        //display the post stored from the database
        return view('dashboard', compact('ideas'));
    }

}
