<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
}
