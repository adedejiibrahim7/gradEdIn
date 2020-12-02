<?php

namespace App\Http\Controllers\Admin;

use App\Mail\AdminMail;
use App\Http\Controllers\Controller;
use App\opportunity;
use App\User;
use Carbon\Carbon;
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
//        $user = auth()->user();
        $data = [];
        $data['users'] = User::count();
        $data['active-openings'] = opportunity::where('status', 'active')->count();
        $data['new-signups'] = DB::table('users')->latest()->limit(5)->get();
        $data['new-openings'] = DB::table('opportunities')->latest()->limit(5)->get();
        $data['signup-count'] = DB::table('users')->where('created_at', '>=', Carbon::now()->subDay())->count();
        $data['login-count'] = DB::table('login_logs')->where('created_at', '>=', Carbon::now()->subDay())->count();

//        dd($data['new-signups']);
        return view('admin.home', compact('data'));
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

            $name = $data['level']. "_" . $this->generateRandomString(2);


            $admin = DB::table('admins')->insert([
               'user_id' => $user->id,
               'level' => $data['level'],
               'name' => $name
            ]);

            $str = $this->generateRandomString(8);
            $count = DB::table('links')->where('text', $str)->count();
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
            Mail::to($user)->send(new AdminMail($user, $link));


            return "Admin Created Successfully";
        });


    }

    public function newUpdate(User $user){

//        dd($user->is_admin);
//        $this->authorize('Admin', $user);
    if($user->is_admin){
//        DB::transaction(function(){
//            dd(\request()->all());
            $data = request()->validate([
                'name' => 'string|min:3|required',
                'avatar' => 'image|mimes:jpg,jpeg,bmp,png|max:2048',
                'password' => 'required|min:6|string|confirmed',
                'email' => 'string'
            ]);
//            $user = User::where('email', $data['email'])->first();
//            if($user->is_admin){
                $user->password = bcrypt($data['password']);
                $user->save();

                $user->admin->name = $data['name'];
                if(request('avatar')){

                    $avatar = request('avatar')->store('uploads/profile/image', 'public');
                }else{
                    $avatar = '';
                }

                $user->admin->avatar = $avatar;
                $user->admin->save();

                return redirect('/home');

//            }
//        });
    }

    }

    public function openings(){
        $openings = opportunity::latest()->paginate(10);
        return view('admin.openings.index', compact('openings'));
    }

    public function pending(){
        $openings = opportunity::where('status', "pending")->latest()->paginate(10);
        return view('admin.openings.pending', compact('openings'));
    }
    public function active(){
        $openings = opportunity::where('status', "active")->latest()->paginate(10);
        return view('admin.openings.active', compact('openings'));
    }
    public function closed(){
        $openings = opportunity::where('status', "closed")->latest()->paginate(10);
        return view('admin.openings.closed', compact('openings'));
    }

    public function users(){
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function recruiters(){
        $users = User::where('user_type', 'recruiter')->where('is_admin', false)->latest()->paginate(20);
        return view('admin.users.recruiters', compact('users'));
    }

    public function seekers(){
        $users = User::where('user_type', 'seeker')->where('is_admin', false)->latest()->paginate(20);
        return view('admin.users.seekers', compact('users'));
    }
    public function admins(){
        $users = User::where('is_admin', true)->latest()->paginate(20);
        return view('admin.users.seekers', compact('users'));
    }
}
