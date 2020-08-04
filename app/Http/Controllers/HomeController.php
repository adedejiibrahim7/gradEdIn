<?php

namespace App\Http\Controllers;

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
        if(auth()->user()->profile !== null){
            return view('opportunities/index');
        }else{
//            return view('profile.create');
            return redirect('/profile-setup');
        }
    }
}
