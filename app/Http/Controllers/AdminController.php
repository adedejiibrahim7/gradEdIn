<?php

namespace App\Http\Controllers;

use App\Mail\AdminMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user = auth()->user();
        return view('admin.home');
    }

    public function manage(){
        return view('admin.manage');
    }

    function generateRandomString($length = 25) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
//usage

    public function createUser(){
//        $this->authorize('is_admin', auth()->user());
        DB::transaction(function (){
            $data = request()->validate([
                'email' => 'email|required',
                'level' => 'string'
            ]);

            $user = User::create([
                'email' => $data['email'],
                'password' => bcrypt(bin2hex(random_bytes(6))),
                'is_admin' => true
            ]);

//            $user = User::where('email', $data['email'])->first();
            $name = $data['level']. "_" . random_bytes(2);
//            dd($user);


            $admin = DB::table('admins')->insert([
               'user_id' => $user->id,
               'level' => $data['level'],
               'name' => $name
            ]);

//            dd($admin);
            $str = $this->generateRandomString(8);
            $count = DB::table('links')->where('text', $str)->count();
//            dd(time());
            if($count != 0){
                $str = $this->generateRandomString(8);
            }else{
                DB::table('links')->insert([
                   'text' => $str,
                   'redirect' => 'admin-new',
                   'status' => "active",
                    'value' => $user->email,
                    'expiry' => time() + 15*60*1000
                ]);

                $link = "gradedin.herokuapp.com/link/".$str;
            }
//            dd($link);
            Mail::to($user)->send(new AdminMail($user, $link));


            return "Admin Created Successfully";
        });


    }

    public function newUpdate(User $user){
        $this->authorize('is_admin', $user);

        DB::transaction(function($user){
            $data = request()->validate([
                'name' => 'string|min:3|required',
                'avatar' => 'image|mimes:jpg,jpeg,bmp,png|max2048',
                'password' => 'required|min:6|string|confirmed'
            ]);
            if($user->is_admin){
                $user->password = $data['password'];
                $user->save();

                $user->admin->name = $data['name'];

                $avatar = request('avatar')->store('uploads/profile/image', 'public');

                $user->admin->avatar = $avatar;
                $user->admin->save();

//                return redirect('/admin');

            }
        });

    }
}
