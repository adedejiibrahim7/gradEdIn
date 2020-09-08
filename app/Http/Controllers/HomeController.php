<?php

namespace App\Http\Controllers;

use App\Application;
use App\opportunity;
use Illuminate\Http\Request;
use App\user;
use App\profile;
use Illuminate\Support\Facades\DB;

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
//            dd($opportunities);
            $status = DB::table('saved_opening')->whereIn('opportunity_id', $opportunities->pluck('id'))->get();
//            dd($status);
            return view('opportunities.index', compact('opportunities', 'status'));
        }elseif(auth()->user()->user_type == "recruiter" && auth()->user()->employerprofile){
            $opportunities = opportunity::where('user_id', auth()->user()->id)->pluck('id');
            $applications = Application::whereIn('opportunity_id', $opportunities)->get();
//            dd($applications);
            return view('employer.index', compact('applications'));
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

    public function home(){
        if(Auth::check()){
            return redirect('/home');
        }else{
            return view('home3');
        }
    }
}
