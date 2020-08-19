<?php

namespace App\Http\Controllers;

use App\EmployerProfile;
use Illuminate\Http\Request;

class EmployerProfileController extends Controller
{
    public function store(){
        $data = request()->validate([
            'title' => ['required', 'string'],
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'institution' => ['required', 'string', 'min:3'],
            'position' => ['required', 'string', 'min:3'],
            'website' => ['required', 'url'],
            'avatar' => ['required', 'image', 'mimes:jpeg,jpg,png,bmp', 'max:2048'],
            'phone' => 'required'

        ]);

        $avatar = request('avatar')->store('uploads/profile/image', 'public');

        EmployerProfile::create([
            'user_id' => auth()->user()->id,
            'avatar' => $avatar,
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'institution_name' => $data['institution'],
            'institution_website' => $data['institution'],
            'phone' => $data['phone']
        ]);

        session()->flash('msg', 'Profile Created!');

        return redirect('/home');
    }
}
