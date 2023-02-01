<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return response()->view('cms.Slider.index', ['sliders' => $sliders]);
    }

    public function changeStatus($id)
    {
        $slider = Slider::Where('id', '=', $id)->first();
        $slider->active = !$slider->active;
        $slider->save();
        return response()->json(
            ['message' => $slider ? 'Change Status successfully' : 'Change Status failed!'],
            $slider ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    public function create()
    {
       
        return response()->view('cms.Slider.create');
    }

    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'title_one' => 'required|string|min:2|max:90',
            'title_two' => 'required|string|min:2|max:90',
            'description' => 'nullable|string',
            'active' => 'nullable|boolean',
            'image' => 'required|image|mimes:png,jpg,jpeg',

        ]);
        if (!$validator->fails()) {
            $slider = new Slider();
            $slider->title_one = $request->input('title_one');
            $slider->title_two = $request->input('title_two');
            $slider->description = $request->input('description');
            $slider->active = $request->input('active');
            if ($request->hasFile('image')) {
                $imagetitle =  time() . '_' . str_replace(' ', '', $slider->title_one) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('slider', $imagetitle, ['disk' => 'public']);
                $slider->image = 'slider/' . $imagetitle;
            }
            $isSaved = $slider->save();
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

    public function edit(Slider $slider)
    {
        return response()->view('cms.Slider.edit',[
            'slider' => $slider
        ]);
    }
    public function update(Request $request, Slider $slider)
    {
        $validator = Validator($request->all(), [
            'title_one' => 'required|string|min:2|max:90',
            'title_two' => 'required|string|min:2|max:90',
            'description' => 'nullable|string',
            'active' => 'nullable|boolean',
            'image' => 'image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            $slider->title_one = $request->input('title_one');
            $slider->title_two = $request->input('title_two');
            $slider->description = $request->input('description');
            $slider->active = $request->input('active');
            if ($request->hasFile('image')) {
                 //Delete  previous image.
                 Storage::delete($slider->image);
                 //Save new image.
                $imagetitle =  time() . '_' . str_replace(' ', '', $slider->title_one) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('slider', $imagetitle, ['disk' => 'public']);
                $slider->image = 'slider/' . $imagetitle;
            }
            $isSaved = $slider->save();
            return response()->json(
                ['message' => $isSaved ? 'Update successfully' : 'Update failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } 
    }

    public function destroy(Slider $slider)
    {
        $deleted = $slider->delete();
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Delete failed!'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}