<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\opportunity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OpportunitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

//        if(auth()->user()->profile){
//            $opportunities = opportunity::all();
//            return view('opportunities.index', compact('opportunities'));
//        }elseif(auth()->user()->employerprofile){
//            return view('employer.index');
//        }
//        else{
//            $type = auth()->user()->user_type;
//            if($type == "seeker"){
//                return view('profile.create');
//            }elseif($type == "recruiter"){
//                return view('user.employer-details');
//            }
//        }

    }

    public function create(){
        return view('opportunities/add');
    }

    public function store(){
//        dd(request()->all());
        DB::transaction(function() {
//            dd(request()->all());
            $data = request()->validate([
               'title' => ['required', 'string'],
               'description' => ['required', 'string'],
                'link' => '',
                'open' => '',
                'close' => '',
                'tags.*' => '',
            ]);

//            if(request('media')){
//    //            dd(request('media'));
//                try {
//                    $media = request('media')->store( 'uploads/opportunities', 'public');
//    //                $media = Storage::disk('public')->put('uploads/opportunities', request('media'));
//    //                dd($media);
//                } catch (\Exception $e) {
//                    dd($e);
//                }
//            }else{
//                $media = '';
//            }
//        $open  = $data['open']
        $take_app = request('take_app') ? true : false;

            $opportunity = auth()->user()->opportunities()->create([
                'title' => $data['title'],
                'description' => $data['description'],
                'link' => $data['link'],
                'open' => $data['open'] !== null ? $data['open'] : null,
                'close' => $data['close'] !== null ? $data['close'] : null,
//                'media' => $media,
                'take_app' => $take_app
            ]);

            $opportunity->tag($data['tags']);
        });

//        session()->flash('msg', 'Opportunity Posted');
//        return redirect('/home');
//        return "Yes";
    }

    public function show(opportunity $opportunity){
//        dd($opportunity);
        $tags = $opportunity->tags;
        return view('opportunities.show', compact('opportunity', 'tags'));
    }
    public function myOpportunities(){

        $opportunities = opportunity::where('user_id', auth()->user()->id)->paginate(10);
        return view('user.my-opportunities', compact('opportunities'));
    }
}
