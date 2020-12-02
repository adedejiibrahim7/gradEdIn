<?php

namespace App\Http\Controllers\Admin;

use App\Mail\AdminMail;
use App\User;
use App\Http\Controllers\Controller;
use App\Mail\CustomMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller implements ShouldQueue
{
    public function  __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.mail.index');
    }

    public function toUser(User $user){
        $email = $user->email;
        return view('admin.mail.toUser', compact('email'));
    }

    public function send(){
        $data = request()->validate([
           'to' => 'email',
           'subject' => '',
           'mailBody' => 'required'
        ]);

        $subject = $data['subject'];
        $body = $data['mailBody'];

//        dd(request()->all());

        Mail::to($data['to'])->queue(new CustomMail($subject, $body));

    }

    public function mailAll(){
        return view('admin.mail.allUser');
    }

    public function toAll(){
//        dd(\request()->all());
        $data = request()->validate([
            'subject' => '',
            'mail-body' => 'required'
        ]);
//        dd(\request()->all());
        if(request('to') == "all"){
            $users = User::get();
        }elseif (\request('to') == "employers"){
            $users = User::where('user_type', 'recruiter')->get();
        }elseif (\request('to') == "seekers"){
            $users = User::where('user_type', 'seeker')->get();
        }
//        dd($users);
//        return false;
        $subject = $data['subject'];
        $body = $data['mail-body'];
        foreach ($users as $user){
//            echo $user;
//            print_r($user);
            Mail::to($user)->queue(new CustomMail($subject, $body));

        }
        session()->flash('success', "The mail will be on its way shortly");
        return redirect('/admin/mail/to-all');
    }


}
