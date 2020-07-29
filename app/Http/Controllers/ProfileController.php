<?php

namespace App\Http\Controllers;


use App\profile;
use App\skills;
use App\User;
use Illuminate\Http\Request;
use App\academic_history;

class ProfileController extends Controller
{
    public function show(User $user){
//        $profile = profile::all()->whereIn('user_id', [$user->id]);
        $profile = $user->profile;
//        dd($profile);
//        $skills = skills::where('profile_id', $profile->id);
        $skills = $profile->skills;
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

    public function store()
    {
//        dd(request()->all());
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
//            'cv' => ['required', 'string'],
//            'cover_letter' => ['required', 'string']
        ]);
//        dd(auth()->user());

        $avatar = request('avatar')->store('uploads/profile/image', 'public');
        $cv = request('cv')->store('uploads/profile/docs', 'public');
        $cover_letter = request('cover_letter')->store('uploads/profile/docs', 'public');

        $profile = auth()->user()->profile()->create([
            'title' => $data['title'],
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'bio' => $data['bio'],
            'avatar' => $avatar,
            'cv' => $cv,
            'cover_letter' => $cover_letter,
        ]);
//        dd($profile->id);
        academic_history::create([
            'school' => $data['school'],
            'course' => $data['course'],
            'certification' => $data['certification'],
            'start' => $data['start'],
            'end' => $data['end'],
            'profile_id' => $profile->id
        ]);

        $profile->skills()->attach($data['skills']);

        session()->flash('msg', 'Profile Created!');
        return redirect('/home');

    }
}
