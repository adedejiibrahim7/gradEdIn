<?php

namespace App\Http\Controllers;

use App\Application;
use App\opportunity;
use App\profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(opportunity $opportunity){
        $this->authorize('view', $opportunity);
        $applicant_profiles = Application::where('opportunity_id', $opportunity->id)->pluck('profile_id');
        $profiles = profile::all()->whereIn('id', $applicant_profiles);
        $resume = Application::where('opportunity_id', $opportunity->id)->whereIn('profile_id', $applicant_profiles)->pluck('resume');
        return view('applications.index', compact('profiles', 'opportunity'));
    }

    public function apply(opportunity $opportunity){
//        dd(request()->all());
        if(request('resume')){
            request()->validate([
               'resume' => ['mime:doc,docx,pdf', 'max:2048']
            ]);
            $resume = request('resume')->store('uploads/application_docs', 'public');

//            $resume = Storage::disk('public')->put('uploads/application_docs', request('resume'));;
        }else{
            $resume = '';
        }
        if(request('cover_letter')){
            request()->validate([
                'cover_letter' => ['mime:doc,docx,pdf', 'max;2048']
            ]);
            $cover_letter = request('cover_letter')->store('uploads/application_docs', 'public');
//            $cover_letter = Storage::disk('public')->put('uploads/application_docs', request('cover_letter'));
        }else{
            $cover_letter = '';
        }
        $applied = Application::all()->where('profile_id', auth()->user()->profile->id)->where('opportunity_id', $opportunity->id);
//        $applied = Application::all()->where('profile_id',  2);

        if($applied->count() == 0){
            Application::create([
                'profile_id' => auth()->user()->profile->id,
                'opportunity_id' => $opportunity->id,
                'resume' => $resume,
                'cover_letter' => $cover_letter
            ]);

            $str = "Application for  $opportunity->title  successsful!";

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
