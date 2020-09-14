<?php

namespace App\Http\Controllers;


use App\certification;
use App\profile;
use App\skills;
use App\User;
use Illuminate\Http\Request;
use App\academic_history;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function create(){
        $profile = profile::where('user_id', auth()->user()->id)->get();
        $user = user::where('id', auth()->user()->id)->first();
        $skills = skills::all();
        if($profile->count() == 0){
            if($user->user_type == "recruiter"){
                return view ('user.employer-details');

            }else{
                return view ('profile.create', compact('skills'));
            }
        }else{
            return redirect("/profile/edit/".auth()->user()->profile->id);
        }
    }
    public function show(User $user){
//        dd(auth()->user()->id);
        $profile = $user->profile;
        $skills = $profile->tags;

        $academic_history = academic_history::where('profile_id', $profile->id)->get();

        return view('profile.show', compact('profile', 'academic_history', 'skills'));
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit(User $user){
        $profile = $user->profile;
        $this->authorize('update', $profile);
//        dd("Will be added soon");
//        $nn = $user->skills->pluck('skill');
//        $notSkills = skills::whereNotIn('skill', $nn)->get();
        return view('profile.edit', compact('profile'));
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
    public function store(request $request)
    {
//        dd(request()->all());
//        if($request->ajax()){

            DB::transaction(function(){
                $data = request()->validate([
                    'title' => ['required', 'string'],
                    'firstName' => ['required', 'string'],
                    'lastName' => ['required', 'string'],
                    'bio' => ['required', 'string'],
                    'school.*' => ['required', 'min:3'],
                    'course.*' => ['required', 'min:3'],
                    'certification.*' => ['required', 'min:3'],
                    'start.*' => 'required',
                    'end.*' => 'required',
                    'skills.*' => '',
                    'avatar' => ['required', 'image', 'mimes:jpeg,jpg,png,bmp', 'max:2048'],
                    'cv' => ['required', 'mimes:doc,docx,pdf', 'max:2048'],
                    'cover_letter' => ['required', 'mimes:doc,docx,pdf', 'max:2048']
                ]);


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

                $profile->tag($data['skills']);

                if(request('ielts') == 'on'){
                    $ielts_score = request()->validate([ 'ielts_score' => 'required' ]);
                    certification::create([
                        'profile_id' => $profile->id,
                        'certification' => 'IELTS',
                        'score' => $ielts_score['ielts_score']
                    ]);
                }
                if(request('gre') == 'on'){
                    $gre_score = request()->validate([ 'gre_score' => 'required' ]);
                    certification::create([
                        'profile_id' => $profile->id,
                        'certification' => 'GRE',
                        'score' => $gre_score['gre_score']
                    ]);
                }
                if(request('toefl') == 'on'){
                    $toefl_score = request()->validate([ 'toefl_score' => 'required' ]);
                    certification::create([
                        'profile_id' => $profile->id,
                        'certification' => 'TOEFL',
                        'score' => $toefl_score['toefl_score']
                    ]);
                }
                if(request('gmat') == 'on'){
                    $gmat_score = request()->validate([ 'gmat_score' => 'required' ]);
                    certification::create([
                        'profile_id' => $profile->id,
                        'certification' => 'GMAT',
                        'score' => $gmat_score['gmat_score']
                    ]);
                }
                for($count = 0; $count<count($data['school']); $count++){
                    academic_history::create([
                        'school' => $data['school'][$count],
                        'course' => $data['course'][$count],
                        'certification' => $data['certification'][$count],
                        'start' => $data['start'][$count],
                        'end' => $data['end'][$count],
                        'profile_id' => $profile->id
                    ]);
                }


//                $profile->skills()->attach($data['skills']);
            });

//        }


        session()->flash('msg', 'Profile Created!');
        return redirect('/home');

    }
}
