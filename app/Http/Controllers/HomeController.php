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
        if(auth()->user()->user_type == "seeker" && auth()->user()->profile){
            $opportunities = opportunity::latest()->paginate(10);
            return view('opportunities.index', compact('opportunities'));
        }elseif(auth()->user()->user_type == "recruiter" && auth()->user()->employerprofile){
            $opportunities = opportunity::where('user_id', auth()->user()->id)->pluck('id');
            $applicants = Application::whereIn('opportunity_id', $opportunities)->get();
            $id = Application::whereIn('opportunity_id', $opportunities)->pluck('profile_id');
            $profiles = profile::whereIn('id', $id)->get();
            return view('employer.index', compact('applicants', 'profiles'));
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
