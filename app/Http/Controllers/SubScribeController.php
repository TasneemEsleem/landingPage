<?php

namespace App\Http\Controllers;

use App\Models\SubScribe;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubScribeController extends Controller
{
    public function index()
    {
        $subscribes = SubScribe::all();
        return response()->view('cms.SubScribe.index', ['subscribes' => $subscribes]);
    }
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email',
        ]);
        if (!$validator->fails()) {
            $subScribe = new SubScribe();
            $subScribe->email = $request->input('email');
            $isSaved = $subScribe->save();
            return response()->json(
                ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

}
