<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return response()->view('cms.service.index', ['services' => $services]);
    }

    public function service()
    {
        $services=Service::where('active', 1)->get();
        return response()->view('landing.service', ['services' => $services]);
    }

    public function changeStatus($id)
    {
        $service = Service::Where('id', '=', $id)->first();
        $service->active = !$service->active;
        $service->save();
        return response()->json(
            ['message' => $service ? 'Change Status successfully' : 'Change Status failed!'],
            $service ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    public function create()
    {
       
        return response()->view('cms.service.create');
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
            $service = new Service();
            $service->title = $request->input('title');
            $service->description = $request->input('description');
            $service->active = $request->input('active');
            if ($request->hasFile('image')) {
                $imagetitle =  time() . '_' . str_replace(' ', '', $service->title) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('service', $imagetitle, ['disk' => 'public']);
                $service->image = 'service/' . $imagetitle;
            }
            $isSaved = $service->save();
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

    public function edit(Service $service)
    {
        return response()->view('cms.service.edit',[
            'service' => $service
        ]);
    }
    public function update(Request $request, Service $service)
    {
        $validator = Validator($request->all(), [
            'title' => 'required|string|min:2|max:90',
            'description' => 'nullable|string',
            'active' => 'nullable|boolean',
            'image' => 'image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            $service->title = $request->input('title');
            $service->description = $request->input('description');
            $service->active = $request->input('active');
            if ($request->hasFile('image')) {
                  //Delete  previous image.
                  Storage::delete($service->image);
                  //Save new image.
                $imagetitle =  time() . '_' . str_replace(' ', '', $service->title) . '.' . $request->file('image')->extension();
                $request->file('image')->storePubliclyAs('service', $imagetitle, ['disk' => 'public']);
                $service->image = 'service/' . $imagetitle;
            }
            $isSaved = $service->save();
            return response()->json(
                ['message' => $isSaved ? 'Update successfully' : 'Update failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } 
    }

    public function destroy(Service $service)
    {
        $deleted = $service->delete();
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Delete failed!'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

}
