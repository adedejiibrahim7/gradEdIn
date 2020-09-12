<?php

namespace App\Http\Controllers;

use App\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{

    public function create(){
        return view('publications.add');
    }

    public function store(){
//        dd(request()->all());
        $data = request()->validate([
           'title.*' => ['required', 'string'],
           'link.*' => ['required', 'url', 'string']
        ]);
        for($count = 0; $count<count($data['title']); $count++){
            Publication::create([
                'title' => $data['title'][$count],
                'link' => $data['link'][$count],
                'user_id' => auth()->user()->id
            ]);
        }
        return "Publication(s) added.. Redirecting";
    }
}
