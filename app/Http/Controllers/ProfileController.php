<?php

namespace App\Http\Controllers;


use App\certification;
use App\profile;
use App\skills;
use App\User;
use Illuminate\Http\Request;
use App\academic_history;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function create(){
        $profile = profile::where('user_id', auth()->user()->id)->count();
        if($profile == 0){
            return view ('profile.create');
        }else{
            return redirect("/profile/edit/".auth()->user()->profile->id);
        }
    }
    public function show(User $user){
//        $profile = profile::all()->whereIn('user_id', [$user->id]);
        $profile = $user->profile;
//        dd($profile);
//        $skills = skills::where('profile_id', $profile->id);
        $skills = $profile->skills;
//        $certifications = $prof
//        dd($skills);
        $academic_history = academic_history::where('profile_id', $profile->id)->get();
//        $academic_history = $user->profile->academic_history;
//        dd($academic_history);
//
        return view('profile.show', compact('profile', 'academic_history', 'skills'));
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit(profile $profile){
        $this->authorize('update', $profile);
//        dd(auth()->user()->profile->user_id);
        $nn = $profile->skills->pluck('skill');
        $notSkills = skills::whereNotIn('skill', $nn)->get();
//        dd($notSkills);
        return view('profile.edit', compact('profile', 'notSkills'));
    }

    public function update(profile $profile){
        $this->authorize('update', $profile);
        dd("Profile Update coming in a jiffy");
//        if(request()->gre == 'on'){
//
//            dd(request()->all());
//        }
//        dd("Hi");
    }
    public function store()
    {
//        dd(request()->all());
//        $this->authorize('create', $user);

        $data = request()->validate([
            'title' => ['required', 'string'],
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'bio' => ['required', 'string'],
            'school' => 'required',
            'course' => 'required',
            'certification' => 'required',
            'start' => 'required',
            'end' => 'required',
            'skills' => ''
        ]);

        $avatar = request('avatar')->store('uploads/profile/image', 'public');
        $cv = request('cv')->store('uploads/profile/docs', 'public');
        $cover_letter = request('cover_letter')->store('uploads/profile/docs', 'public');
//        $avatar = Storage::disk('public')->put('uploads/profile/image', request('avatar'));
//        $cv = Storage::disk('public')->put('uploads/profile/docs', request('cv'));
//        $cover_letter = Storage::disk('public')->put('uploads/profile.docs', request('cover_letter'));

        $profile = auth()->user()->profile()->create([
            'title' => $data['title'],
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'bio' => $data['bio'],
            'avatar' => $avatar,
            'cv' => $cv,
            'cover_letter' => $cover_letter,
        ]);

        academic_history::create([
            'school' => $data['school'],
            'course' => $data['course'],
            'certification' => $data['certification'],
            'start' => $data['start'],
            'end' => $data['end'],
            'profile_id' => $profile->id
        ]);

        if(request()->ielts){
            certification::create([
               'profile_id' => $profile->id,
                'certification' => 'ielts'
            ]);
        }
        if(request()->gre) {
            certification::create([
                'profile_id' => $profile->id,
                'certification' => 'gre'
            ]);
        }
        if(request()->toefl) {
            certification::create([
                'profile_id' => $profile->id,
                'certification' => 'toefl'
            ]);
        }
        $profile->skills()->attach($data['skills']);

        session()->flash('msg', 'Profile Created!');
        return redirect('/home');

    }
}
