<?php

namespace App\Http\Controllers;

use App\Application;
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
        $applied = Application::where('opportunity_id', $opportunity->id)->where('profile_id', auth()->user()->profile->id)->get();
//        if(count($applied) == 0){
//
//            dd($applied);
//        }else{
//            dd("Hello");
//        }
        return view('opportunities.show', compact('opportunity', 'tags', 'applied'));
    }
    public function myOpportunities(){

        $opportunities = opportunity::where('user_id', auth()->user()->id)->paginate(10);
        return view('user.my-opportunities', compact('opportunities'));
    }

    public function save(opportunity $opportunity){
        $v = DB::table('saved_opening')->where('opportunity_id', $opportunity->id)->where('user_id', auth()->user()->id);
        if($v->count() == 0) {
            DB::table('saved_opening')->insert([
                'user_id' => auth()->user()->id,
                'opportunity_id' => $opportunity->id,

            ]);
            return "saved";
        }elseif ($v->count() > 0){
//            $opportunity->delete();
//            $so = $v->first();
            $status = $v->first()->status;
//            dd($status);
            if($status == "saved"){
                $v->update(['status' => "unsaved"]);
                return "1";
            }elseif ($status == "unsaved"){
                $v->update(['status' => "saved"]);
                return "2";
            }
//            $so->save();
            return "done";
//            $v->first()->delete();
//            return "unsaved";
        }
    }

    public function savedOpenings(){
        $so = DB::table('saved_opening')->where('user_id', auth()->user()->id)->where('status', "saved");
        $opportunities = opportunity::whereIn('id', $so->pluck('opportunity_id'))->paginate(10);
        return view('saved-openings', compact('opportunities'));
    }

    public function approve(opportunity $opportunity){
       if(auth()->user()->is_admin){
           $opportunity->status = "active";
           $opportunity->save();

           return redirect('/admin/openings');
       }else{
           return redirect('/home');
       }
    }


}
