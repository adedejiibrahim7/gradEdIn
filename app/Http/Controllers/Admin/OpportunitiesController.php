<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Opportunity;
use Illuminate\Http\Request;

class OpportunitiesController extends Controller
{

    public function index()
    {
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

    public function close(opportunity $opportunity){
        if(auth()->user()->is_admin){
            $opportunity->status = "closed";
            $opportunity->save();

            return redirect('/admin/openings');
        }else{
            return redirect('/home');
        }
    }
}
