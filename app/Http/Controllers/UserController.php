<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function settings(){
        $user_type = auth()->user()->user_type;
        return view('user.settings', compact('user_type'));
    }

    public function switch(){
        if(request('switch')){
//            dd(request('switch'));

            $type = auth()->user()->user_type;
//            dd($type);
            $user = User::find(auth()->user()->id);
            if(request('switch') == "on"){
//                dd($user);
                if($type == "seeker"){
                    $user->user_type = "recruiter";
                    if($user->save()){
//                        dd("Done");
                    }
                }elseif ($type == "recruiter"){
                    $user->user_type = "seeker";
                    $user->save();
                }
            }
        }
        return redirect('/home');
    }

    public function follow(User $user){
        if($user->is_admin){
            $mentee = auth()->user()->id;

            $mm = DB::table('mentor_mentee')->where('mentor', $user->id)
                ->where('mentee', $mentee);
            if($mm->count() > 0){
                $status = $mm->first()->status;

                if($status != "follows"){
                    $mm->update(['status' => "follows"]);
                }else{
                    $mm->update(['status' => "not-follows"]);
                }
            }else{
                DB::table('mentor_mentee')->insert([
                   'mentor' => $user->id,
                    'mentee' => $mentee
                ]);
            }
        }
    }
}
