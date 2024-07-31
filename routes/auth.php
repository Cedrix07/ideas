<?php
    use App\Http\Controllers\AuthController;
    use Illuminate\Support\Facades\Route;

    /* User Auth Routes only! */
    /* Adding route group or adding middleware guest  */
    Route::group(['middleware'=>'guest'],function(){
        //Registration View route
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        //Registration route for submitting user details (Proccess)
        Route::post('/register', [AuthController::class, 'store']);
        //Login view Route:
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        //Login Process Route:
        Route::post('/login', [AuthController::class, 'authenticate']);
    });

    //logout route
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
