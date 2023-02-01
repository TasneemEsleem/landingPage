<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\Information;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactUsController extends Controller
{
    public function index()
    {
        $contactuss = ContactUs::all();
        return response()->view('cms.ContactUs.index', ['contactuss' => $contactuss]);
    }
    public function contanct()
    {
        $information = Information::where('active', '=', 1)->first();

        return response()->view('landing.contactus',['information' => $information]);

    }

    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:2|max:90',
            'email' => 'required|email',
            'phone' => 'required|max:10',
            'message' => 'required',
        ]);
        if (!$validator->fails()) {
            $contactus = new ContactUs();
            $contactus->name = $request->input('name');
            $contactus->email = $request->input('email');
            $contactus->phone = $request->input('phone');
            $contactus->message = $request->input('message');
            $isSaved = $contactus->save();
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

}
