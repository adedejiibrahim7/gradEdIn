<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\opportunity;

class OpportunitiesController extends Controller
{
    public function index(){
        $opportunities = opportunity::all();
        return view('opportunities.index', compact('opportunities'));
    }

    public function create(){
        return view('opportunities/add');
    }

    public function store(){
        $data = request()->validate([
           'title' => ['required', 'string'],
           'description' => ['required', 'string'],
            'link' => '',
            'open' => '',
            'close' => '',
        ]);

        if(request('media')){
            $media = request('media')->store( 'uploads/opportunities', 'public');
        }else{
            $media = '';
        }

        $take_app = request('take_app') ? true : false;
        $opportunity = auth()->user()->opportunities()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'link' => $data['link'],
            'open' => $data['open'],
            'close' => $data['close'],
//            'media' => $media,
            'media' => 'uploads/opportunities/6jHNLxQ5eOFQp0O1sRaUZRJMi2qEqDUBIgPujNrh.jpeg',
//            'deleted_at' => null,
            'take_app' => $take_app
        ]);

        session()->flash('msg', 'Opportunity Posted');
        return redirect('/home');
    }

    public function show(opportunity $opportunity){
//        dd($opportunity);
        return view('opportunities.show', compact('opportunity'));
    }
}