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
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        if($user->user_type == 'seeker'){
            $profile = $user->profile;
            $skills = $profile->tags;

            $academic_history = academic_history::where('profile_id', $profile->id)->get();

            return view('profile.show', compact('profile', 'academic_history', 'skills'));
        }elseif ($user->user_type == 'recruiter'){
            $profile = $user->employerprofile;
            return view('employer.profile', compact('profile'));
        }

    }



    public function edit(User $user){
        $profile = $user->profile;
        $this->authorize('update', $profile);
        return view('profile.edit', compact('profile'));
    }

    public function update(){

        $profile = auth()->user()->profile;
        $this->authorize('update', $profile);

        if(request('bio')){
            $data = request()->validate([
                'bio' => 'required|string|min:3|max:250'

            ]);
            if(request('avatar')){
                $val = \request()->validate([
                    'avatar' => 'required|max:2048|image|mimes:jpg,jpeg,png,bmp'
                ]);
                $avatar = request('avatar')->store('uploads/profile/image', 'public');
                $profile->avatar = $avatar;
            }

            $profile->bio = $data['bio'];
            $profile->save();
            dd("Done");
        }

        if(request('first_name')){
            $data = request()->validate([
                'title' => 'required',
                'first_name' => 'string|min:3|max:250',
                'last_name' => 'string|min:3|max:250',
            ]);

            $profile->first_name = $data['first_name'];
            $profile->last_name = $data['last_name'];
            $profile->save();
        }
    }

    public function ach(){
        $profile = auth()->user()->profile;
        $this->authorize('update', $profile);
        if(\request('school')){
            dd(\request()->all());
        }
        dd(\request()->all());
    }

    public function store(request $request)
    {
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
                    'cover_letter' => [ 'mimes:doc,docx,pdf', 'max:2048']
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


            });
        session()->flash('msg', 'Profile Created!');
        return redirect('/home');
    }
}
