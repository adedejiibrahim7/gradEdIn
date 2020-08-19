<?php

namespace App\Http\Controllers;

use App\Application;
use App\opportunity;
use Illuminate\Http\Request;
use App\user;
use App\profile;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->profile){
            $opportunities = opportunity::all();
            return view('opportunities.index', compact('opportunities'));
        }elseif(auth()->user()->employerprofile){
            $opportunities = opportunity::where('user_id', auth()->user()->id)->pluck('id');
            $applicants = Application::whereIn('opportunity_id', $opportunities)->get();
//            dd(Application::all());
            return view('employer.index', compact('applicants'));
        }
        else{
            $type = auth()->user()->user_type;
            if($type == "seeker"){
                return view('profile.create');
            }elseif($type == "recruiter"){
                return view('user.employer-details');
            }
        }
    }
}
