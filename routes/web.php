<?php

use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\IdeaController as AdminIdeaController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
    Controller : Handles request
    Model : handle data logic and interaction with database
    view : what should be shown to the user (HTML and CSS code / Blade files)
*/



/*
    //Route grouping (Grouping the route for Ideas functionality)
    Route::group(['prefix' => 'ideas/', 'as' => 'ideas.', 'middleware' => ['auth']], function () {
        //Show specific idea in the web
        Route::get('/{idea}', [IdeaController::class, 'show'])->name('show');

        Route::group(['middleware'=>['auth']], function(){

            //Create idea Route
            Route::post('/', [IdeaController::class, 'store'])->name('store');

            //Edit ideas view Route
            Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('edit');

            //Update ideas Route (Update Process)
            Route::put('/{idea}', [IdeaController::class, 'update'])->name('update');

            //Delete ideas Route
            Route::delete('/{idea_id}', [IdeaController::class, 'destroy'])->name('destroy');

            //Route for creating a comment to a specific post
            Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('comments.store');

        });
    });
*/

//route for changing language of website
Route::get('lang/{lang}', function($lang){
    app()->setLocale($lang);
    session()->put('locale', $lang);

    return redirect()->route('dashboard');
})->name('lang');

// View route for main page:
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//creating route with middleware auth
Route::resource('ideas',IdeaController::class)->except(['index','create','show'])->middleware('auth');

//Creating a route without middleware
Route::resource('ideas',IdeaController::class)->only(['show']);

//For Comment Route: ideas/{idea}/comments/
Route::resource('ideas.comments',CommentController::class)->only(['store'])->middleware('auth');

//Profile Page Route view
Route::resource('users',UserController::class)->only('show');
Route::resource('users',UserController::class)->only('edit','update')->middleware('auth');

Route::get('profile',[UserController::class, 'profile'])->middleware('auth')->name('profile');

//Follow  unfollow Routes
Route::post('users/{user}/follow',[FollowerController::class,'follow'])->middleware('auth')->name('users.follow');
Route::post('users/{user}/unfollow',[FollowerController::class,'unfollow'])->middleware('auth')->name('users.unfollow');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

//Likes  & unlike  route
Route::post('ideas/{idea}/like',[IdeaLikeController::class,'like'])->middleware('auth')->name('ideas.like');
Route::post('ideas/{idea}/unlike',[IdeaLikeController::class,'unlike'])->middleware('auth')->name('ideas.unlike');


//Feed Route        Invokable controller so no need to call the method inside the controller
Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');


//Admin Routes > passing the 'class' to check
Route::middleware(['auth','can:admin'])->prefix('/admin')->as('admin.')->group(function(){
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users',AdminUserController::class)->only('index');
    Route::resource('ideas',AdminIdeaController::class)->only('index');
    Route::resource('comments',AdminCommentController::class)->only('index','destroy');

});



