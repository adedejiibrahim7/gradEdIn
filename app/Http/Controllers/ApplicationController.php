<?php

namespace App\Http\Controllers;

use App\Application;
use App\opportunity;
use App\profile;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(opportunity $opportunity){
        $applicant_profiles = Application::where('opportunity_id', $opportunity->id)->pluck('profile_id');
        $profiles = profile::all()->whereIn('id', $applicant_profiles);
//        dd(Application::all());
        return view('applications.index', compact('profiles', 'opportunity'));
    }

    public function apply(opportunity $opportunity){

        if(request('resume')){
            request('resume')->store('uploads/application_docs', 'public');
        }
        if(request('cover_letter')){
            request('cover_letter')->store('uploads/application_docs', 'public');
        }
        $applied = Application::all()->where('profile_id', auth()->user()->profile->id);
//        $applied = Application::all()->where('profile_id',  2);
        if($applied->count() == 0){
            Application::create([
                'profile_id' => auth()->user()->profile->id,
                'opportunity_id' => $opportunity->id,
                'resume' => 'document',
                'cover_letter' => 'document'
            ]);

            $str = "Application for {{ $opportunity->title }} successsful!";

        }else{
            $str = "You already applied for {{ $opportunity->title }}";
        }

//        dd($str);
        session()->flash('msg', $str);
        $opportunities = opportunity::all();
//        return view('opportunities.index', compact('opportunities'));
        return redirect('/opportunities');
    }

    public function myApplications(){
        $applications = Application::where('profile_id', auth()->user()->profile->id)->paginate(10);
        return view('user/applications', compact('applications'));
    }
}
