<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class InformationController extends Controller
{
    public function index()
    {
        $informations = information::all();
        return response()->view('cms.information.index', ['informations' => $informations]);
    }

    public function changeStatus($id)
    {
        $information = information::Where('id', '=', $id)->first();
        $information->active = !$information->active;
        $information->save();
        return response()->json(
            ['message' => $information ? 'Change Status successfully' : 'Change Status failed!'],
            $information ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
    public function create()
    {
       
        return response()->view('cms.information.create');
    }

    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'phone' => 'required|max:10',
            'email' => 'required|email',
            'facebook' => 'string',
            'twitter' => 'string',
            'linkedIn' => 'string',
            'instagram' => 'string',
            'active' => 'nullable|boolean',
            'logo' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            $information = new information();
            $information->email = $request->input('email');
            $information->phone = $request->input('phone');
            $information->facebook = $request->input('facebook');
            $information->twitter = $request->input('twitter');
            $information->linkedIn = $request->input('linkedIn');
            $information->instagram = $request->input('Instagram');
            $information->active = $request->input('active');
            if ($request->hasFile('logo')) {
                $imagetitle =  time() . '_' . str_replace(' ', '', $information->email) . '.' . $request->file('logo')->extension();
                $request->file('logo')->storePubliclyAs('information', $imagetitle, ['disk' => 'public']);
                $information->logo = 'information/' . $imagetitle;
            }
            $isSaved = $information->save();
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

    public function edit(information $information)
    {
        return response()->view('cms.information.edit',[
            'information' => $information
        ]);
    }
    public function update(Request $request, information $information)
    {
        $validator = Validator($request->all(), [
            'phone' => 'required|max:10',
            'email' => 'required|email',
            'facebook' => 'string',
            'twitter' => 'string',
            'linkedIn' => 'string',
            'instagram' => 'string',
            'active' => 'nullable|boolean',
            'logo' => 'image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            $information->email = $request->input('email');
            $information->phone = $request->input('phone');
            $information->facebook = $request->input('facebook');
            $information->twitter = $request->input('twitter');
            $information->linkedIn = $request->input('linkedIn');
            $information->instagram = $request->input('Instagram');
            $information->active = $request->input('active');
            if ($request->hasFile('logo')) {
                  //Delete  previous image.
                  Storage::delete($information->logo);
                  //Save new image.
                $imagetitle =  time() . '_' . str_replace(' ', '', $information->email) . '.' . $request->file('logo')->extension();
                $request->file('logo')->storePubliclyAs('information', $imagetitle, ['disk' => 'public']);
                $information->logo = 'information/' . $imagetitle;
            }
            $isSaved = $information->save();
            return response()->json(
                ['message' => $isSaved ? 'Update successfully' : 'Update failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } 
    }

    public function destroy(Information $information)
    {
        $deleted = $information->delete();
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Delete failed!'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
