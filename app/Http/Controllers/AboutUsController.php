<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUss = AboutUs::all();
        return response()->view('cms.aboutUs.index', ['aboutUss' => $aboutUss]);
    }
    public function about()
    {
        $aboutus=AboutUs::where('active', '=', 1)->first();
        return response()->view('landing.about', ['aboutus' => $aboutus]);

    }


    public function changeStatus($id)
    {
        $aboutUs = AboutUs::Where('id', '=', $id)->first();
        $aboutUs->active = !$aboutUs->active;
        $aboutUs->save();
        return response()->json(
            ['message' => $aboutUs ? 'Change Status successfully' : 'Change Status failed!'],
            $aboutUs ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    public function create()
    {
       
        return response()->view('cms.aboutUs.create');
    }

    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'title' => 'required|string|min:2|max:90',
            'description' => 'nullable|string',
            'active' => 'nullable|boolean',
            'image' => 'required|image|mimes:png,jpg,jpeg',

        ]);
        if (!$validator->fails()) {
            $aboutUs = new AboutUs();
            $aboutUs->title = $request->input('title');
            $aboutUs->description = $request->input('description');
            $aboutUs->active = $request->input('active');
            if ($request->hasFile('image')) {
                $imagetitle =  time() . '_' . str_replace(' ', '', $aboutUs->title_one) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('aboutUs', $imagetitle, ['disk' => 'public']);
                $aboutUs->image = 'aboutUs/' . $imagetitle;
            }
            $isSaved = $aboutUs->save();
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

    public function edit(AboutUs $aboutu)
    {
        return response()->view('cms.aboutUs.edit',[
            'aboutu' => $aboutu
        ]);
    }
    public function update(Request $request, AboutUs $aboutu)
    {
        $validator = Validator($request->all(), [
            'title' => 'required|string|min:2|max:90',
            'description' => 'nullable|string',
            'active' => 'nullable|boolean',
            'image' => 'image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            $aboutu->title = $request->input('title');
            $aboutu->description = $request->input('description');
            $aboutu->active = $request->input('active');
            if ($request->hasFile('image')) {
                //Delete  previous image.
                   Storage::delete($aboutu->image);
                //Save new image.
                $imagetitle =  time() . '_' . str_replace(' ', '', $aboutu->title_one) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('aboutUs', $imagetitle, ['disk' => 'public']);
                $aboutu->image = 'aboutUs/' . $imagetitle;
            }
            $isSaved = $aboutu->save();
            return response()->json(
                ['message' => $isSaved ? 'Update successfully' : 'Update failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } 
    }

    public function destroy(AboutUs $aboutu)
    {
        $deleted = $aboutu->delete();
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Delete failed!'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
