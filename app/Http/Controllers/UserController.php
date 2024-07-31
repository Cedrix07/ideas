<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
     /**
     * Show the form for editing the specified resource.
     */
    public function show(User $user)
    {
       $ideas = $user->ideas()->paginate(5);
        return view("users.show", compact("user", "ideas"));
    }


    public function edit(User $user)
    {
        //userpolicy
        $this->authorize('update',$user);

        $editing = true;
        $ideas = $user->ideas()->paginate(5);
        return view("users.shared.edit", compact("user","editing","ideas"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //user policy
        $this->authorize('update',$user);

        //Calling the Request > UpdateUserRequest file for validation
        $validated = $request->validated();

        if($request->has('image')){
            $imagePath = $request->file('image')->store('profile','public');
            $validated['image'] = $imagePath;

            //Delete the old profile image after replacing by new profile image
            Storage::disk('public')->delete($user->image ?? '');
        }

        $user->update($validated);

        return redirect()->route('profile');
    }

    public function profile()
    {
        //calling the show method and pass the current login user
        return $this->show(auth()->user());
    }
}
