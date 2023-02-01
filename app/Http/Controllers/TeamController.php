<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{
  public function index()
    {
        $teams = Team::all();
        return response()->view('cms.team.index', ['teams' => $teams]);
    }
    public function Team()
    {
        $teams=Team::where('active', '=', 1)->get();
        return response()->view('landing.team', ['teams' => $teams]);
    }
    public function changeStatus($id)
    {
        $team = Team::Where('id', '=', $id)->first();
        $team->active = !$team->active;
        $team->save();
        return response()->json(
            ['message' => $team ? 'Change Status successfully' : 'Change Status failed!'],
            $team ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    public function create()
    {
       
        return response()->view('cms.team.create');
    }

    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'title' => 'required|string|min:2|max:90',
            'description' => 'nullable|string',
            'facebook' => 'string',
            'twitter' => 'string',
            'linkedIn' => 'string',
            'Instagram' => 'string',
            'active' => 'nullable|boolean',
            'image' => 'required|image|mimes:png,jpg,jpeg',

        ]);
        if (!$validator->fails()) {
            $team = new team();
            $team->title = $request->input('title');
            $team->description = $request->input('description');
            $team->facebook = $request->input('facebook');
            $team->twitter = $request->input('twitter');
            $team->linkedIn = $request->input('linkedIn');
            $team->Instagram = $request->input('Instagram');
            $team->active = $request->input('active');
            if ($request->hasFile('image')) {
                $imagetitle =  time() . '_' . str_replace(' ', '', $team->title_one) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('team', $imagetitle, ['disk' => 'public']);
                $team->image = 'team/' . $imagetitle;
            }
            $isSaved = $team->save();
            return response()->json(
                ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    public function edit(team $team)
    {
        return response()->view('cms.team.edit',[
            'team' => $team
        ]);
    }
    public function update(Request $request, team $team)
    {
        $validator = Validator($request->all(), [
            'title' => 'required|string|min:2|max:90',
            'description' => 'nullable|string',
            'facebook' => 'string',
            'twitter' => 'string',
            'linkedIn' => 'string',
            'Instagram' => 'string',
            'active' => 'nullable|boolean',
            'image' => 'image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            $team->title = $request->input('title');
            $team->description = $request->input('description');
            $team->facebook = $request->input('facebook');
            $team->twitter = $request->input('twitter');
            $team->linkedIn = $request->input('linkedIn');
            $team->Instagram = $request->input('Instagram');
            $team->active = $request->input('active');
            if ($request->hasFile('image')) {
                  //Delete  previous image.
                  Storage::delete($team->image);
                  //Save new image.
                $imagetitle =  time() . '_' . str_replace(' ', '', $team->title_one) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('team', $imagetitle, ['disk' => 'public']);
                $team->image = 'team/' . $imagetitle;
            }
            $isSaved = $team->save();
            return response()->json(
                ['message' => $isSaved ? 'Update successfully' : 'Update failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } 
    }

    public function destroy(team $team)
    {
        $deleted = $team->delete();
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Delete failed!'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

}
