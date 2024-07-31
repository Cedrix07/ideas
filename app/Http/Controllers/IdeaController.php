<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    //Add new post
    public function store(CreateIdeaRequest $request)
    {
        //Form Request Validations is performed in Request file
        $validated = $request->validated();

        //get the id of current user when creating new idea
        $validated['user_id'] = auth()->id();

        Idea::create($validated);

        return redirect()->route("dashboard")->with("success", "Idea was created successfully");
    }

    //showing a specific idea post
    public function show(Idea $idea)
    {
        return view("ideas.show", compact("idea"));
    }

    //Edit a specific idea post (Showing the edit page of the post)
    public function edit(Idea $idea)
    {
        $this->authorize('update', $idea); //To prevents other user to edit/update someone's post; Calling the method for update in IdeaPolicy File
        $editing = true;

        return view("ideas.show", compact("idea", "editing"));
    }

    //update a specific idea post
    public function update(UpdateIdeaRequest $request, Idea $idea)
    {
        $this->authorize('update',$idea); //To prevents other user to edit/update someone's post; Calling the method for update in IdeaPolicy File
        $editing = true;
        $validated = $request->validated();

        $idea->update(['content' => $validated['content']]);
        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea Updated Successfully');
    }

    //deleting a specific post
    public function destroy(Idea $idea)
    {
        //To prevents other user to delete someone's post; Calling the method for delete in IdeaPolicy File
        $this->authorize('delete',$idea);

        //delete the first matches value
        $idea->delete();
        return redirect()->route("dashboard")->with("success", "Idea deleted successfully");
    }
}
