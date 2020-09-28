<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function createUser(){
//        $this->authorize('is_admin', auth()->user());
        DB::transaction(function (){
            $data = request()->validate([
                'email' => 'email|required',
                'level' => 'string'
            ]);

            User::create([
                'email' => $data['email'],
                'password' => bcrypt(bin2hex(random_bytes(6))),
                'is_admin' => true
            ]);

            $user = User::where('email', $data['email'])->get();
            $name = $data['level']. "_" . random_bytes(2);

            DB::table('admin')->insert([
               'user_id' => $user->id,
               'level' => $data['level'],
               'name' => $name
            ]);

            $str = random_bytes(8);
            $count = DB::table('links')->where('text', $str)->count();

            if($count != 0){
                $str = random_bytes(8);
            }else{
                DB::table('links')->insert([
                   'text' => $str,
                   'redirect' => 'admin-new',
                   'status' => "active",
                    'value' => $user->email
                ]);
            }

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

                return redirect('/admin');

            }
        });

    }
}
