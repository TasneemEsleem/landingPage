<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\ContactUs;
use App\Models\Information;
use App\Models\Service;
use App\Models\Slider;
use App\Models\SubScribe;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function index()
    {
        $information = Information::where('active', '=', 1)->first();
        $slider=Slider::where('active', '=', 1)->first();
        $aboutus=AboutUs::where('active', '=', 1)->first();
        $teams=Team::where('active', '=', 1)->limit(2)->get();
        $services=Service::where('active', 1)->limit(2)->get();
        $subscribes = SubScribe::count();
        $team=Team::count();
        $users=User::count();
        $contactus = ContactUs::count();


        //  dd($services);
        return Response()->view('landing.home', ['information' => $information
    , 'slider'=>$slider,'services'=>$services,'teams'=>$teams,
    'aboutus' => $aboutus,'subscribes' => $subscribes
    ,'team' => $team , 'users'=>$users , 'contactus'=>$contactus
]);
    }
}
