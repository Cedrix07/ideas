<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //REGISTER VIEW
    public function register()
    {
        return view("auth.register");
    }

    //Submitting user details to register
    public function store()
    {
        $validated = request()->validate([
            'name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8'
        ]);

        $user = User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'] //password is already hashed in model at $casts 
            ]
        );

        //sending thank you email after user registration
        Mail::to($user->email)->send(new WelcomeMail($user)); //passing the logged in user ($user)

        return redirect()->route('dashboard')->with('success', 'Account created Successfully!');
    }

    public function login()
    {
        return view("auth.login");
    }

    //Submitting user details to register
    public function authenticate()
    {
        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (auth()->attempt($validated)){
            //clear session
            request()->session()->regenerate();
            return redirect()->route('dashboard')->with('success','Logged in successfully!');
        }

        return redirect()->route('login')->withErrors(['email'=>'No matching user found with the provided email and password']);
    }

    //logout user
    public function logout(){
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('dashboard')->with('success', 'Logged out Successfully!');
        // return redirect()->route('login')->with('success', 'Logged out Successfully!');
    }
}
