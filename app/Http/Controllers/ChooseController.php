<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\SubScribe;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class ChooseController extends Controller
{
    public function index()
    {
        $subscribes = SubScribe::count();
        $teams=Team::count();
        $users=User::count();
        $contactus = ContactUs::count();

        return response()->view('landing.choose', ['subscribes' => $subscribes
    ,'teams' => $teams , 'users'=>$users , 'contactus'=>$contactus]);
    }
}
